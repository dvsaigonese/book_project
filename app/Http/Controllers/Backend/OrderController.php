<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.order');
    }

    public function changeOrderStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->order_status = $request->order_status;
        $order->save();
        return redirect()->route('admin.order.index')->with('toast', ['status' => 'success', 'message' => 'Updated Successfully!']);
    }

    public function changePaymentStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->payment_status = $request->payment_status;
        $order->save();
        return redirect()->route('admin.order.index')->with('toast', ['status' => 'success', 'message' => 'Updated Successfully!']);
    }
}
