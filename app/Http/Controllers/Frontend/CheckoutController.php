<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('account')->with('warning', 'If you want to buy something, you must login first!');
        } else {
            $carts = Cart::where('user_id', Auth::id())
                ->leftJoin('books', 'carts.book_id', '=', 'books.id')
                ->leftJoin('book_price', 'book_price.book_id', '=', 'books.id')
                ->where('book_price.status', 1)
                ->select('carts.*',
                    'books.image as image',
                    'books.name as name',
                    'books.slug as slug',
                    'book_price.book_price as book_price')
                ->get();

            if (!isset($carts[0]->name)) {
                return redirect()->route('books')->with('warning', 'You must add a book to your cart before checkout!');
            }

            $weight = Cart::where('user_id', Auth::id())
                ->leftJoin('books', 'carts.book_id', '=', 'books.id')
                ->leftJoin('book_price', 'book_price.book_id', '=', 'books.id')
                ->sum('books.weight');

            if (isset($_GET['vnp_SecureHash'])) {
                $checkout_status = $this->vnpay_irn();

                if ($checkout_status == 1) {
                    return redirect()->route('home')->with('success', 'Order Successfully Placed!');
                } else {
                    return redirect()->route('home')->with('error', 'Order failed, please check your information as well as your connection and try again!');
                }
            }

            return view('pages.checkout', compact('carts', 'weight'));
        }
    }

    public function cashOnDelivery(Request $request) {
        $this->storeOrder($request);

        try {
            $order = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->first();

            $order_details = Cart::where('user_id', Auth::id())
                ->leftJoin('books', 'carts.book_id', '=', 'books.id')
                ->leftJoin('book_price', 'book_price.book_id', '=', 'books.id')
                ->get();

            foreach ($order_details as $item) {
                $details = [
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                    'price' => $item->book_price * $item->quantity,
                ];

                try {
                    OrderDetail::create($details);
                } catch (\Exception $e) {
                    dd($e);
                }

                try {
                    DB::table('carts')
                        ->where('book_id', $item->book_id)
                        ->where('user_id', Auth::id())
                        ->delete();
                } catch (\Exception $e) {
                    dd($e);
                }
            }

            return redirect()->route('home')->with('success', 'Order Successfully Placed!');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function storeOrder(Request $request)
    {
        if ($request->has('coupon_id')){
            $data = [
                'user_id' => Auth::id(),
                'coupon_id' => $request->coupon_id,
            ];

            DB::table('user_has_coupons')->insert($data);
        }

        $request = $request->merge([
            'user_id' => Auth::id(),
            'order_status' => 0,
            'payment_status' => 0
        ]);
        //dd($request->all());

        return Order::create($request->all());
    }

    public function vnpay_payment(Request $request)
    {
        $this->storeOrder($request);

        $last_Order = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->first();

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://borrow_book_project.test/checkout";
        $vnp_TmnCode = "EM1AKNTL";//Mã website tại VNPAY
        $vnp_HashSecret = "TDJISBBUAJGHODUPPUTYDAKAHQCNTXFO"; //Chuỗi bí mật
        $vnp_Version = "2.1.0";
        $vnp_CreateDate = date('YmdHis');
        $vnp_TxnRef = $last_Order->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $last_Order->total_price * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_OrderInfo = "Thanh toan";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
        //$vnp_ExpireDate = $_POST['txtexpire'];

        $inputData = array(
            "vnp_Version" => $vnp_Version,
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_OrderInfo" => $vnp_OrderInfo,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

//var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            //dd($vnp_Url);
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);


        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);

            die();

        } else {
            echo json_encode($returnData);
        }

        // vui lòng tham khảo thêm tại code demo
    }

    public function vnpay_irn()
    {
        /* Payment Notify
           * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
           * Các bước thực hiện:
           * Kiểm tra checksum
           * Tìm giao dịch trong database
           * Kiểm tra số tiền giữa hai hệ thống
           * Kiểm tra tình trạng của giao dịch trước khi cập nhật
           * Cập nhật kết quả vào Database
           * Trả kết quả ghi nhận lại cho VNPAY
           */

        //include(config_path() . '\app.php');
        $vnp_HashSecret = "TDJISBBUAJGHODUPPUTYDAKAHQCNTXFO"; //Chuỗi bí mật

        $inputData = array();
        $returnData = array();

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        //dd($inputData);

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi

        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);

                $order = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->first();
                // dd($order->order_status);
                if ($order != NULL) {
                    if ($order->total_price == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng. $order["Amount"] == $vnp_Amount
                    {
                        if ($order->order_status == 0) {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $Status = 1; // Trạng thái thanh toán thành công
                                //echo 1;
                            } else {
                                $Status = 2; // Trạng thái thanh toán thất bại / lỗi
                               // echo 2;
                            }
                            //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                            //
                            //
                            //
                            //Trả kết quả về cho VNPAY: Website/APP TMĐT ghi nhận yêu cầu thành công
                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'Invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknown error';
        }
        //Trả lại VNPAY theo định dạng JSON
        //dd($returnData);

        if ($Status == 1) {

            $order_details = Cart::where('user_id', Auth::id())
                ->leftJoin('books', 'carts.book_id', '=', 'books.id')
                ->leftJoin('book_price', 'book_price.book_id', '=', 'books.id')
                ->get();

            foreach ($order_details as $item) {
                $details = [
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                    'price' => $item->book_price * $item->quantity,
                ];

                try {
                    OrderDetail::create($details);
                } catch (\Exception $e) {
                    dd($e);
                }

                try {
                    DB::table('carts')
                        ->where('book_id', $item->book_id)
                        ->where('user_id', Auth::id())
                        ->delete();
                } catch (\Exception $e) {
                    dd($e);
                }

            }

            $order->payment_status = 1;
            $order->save();

            return 1;

        } else {
            try {
                $order->delete();
                return 0;
            }
            catch (\Exception $e) {
                dd($e);
            }
        }

    }
}
