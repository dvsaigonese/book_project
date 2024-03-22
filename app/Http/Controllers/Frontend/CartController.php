<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::id())
                ->leftJoin('books', 'carts.book_id', '=', 'books.id')
                ->leftJoin('book_price', 'book_price.book_id', '=', 'books.id')
                ->select('carts.*',
                    'books.image as image',
                    'books.name as name',
                    'books.slug as slug',
                    'book_price.book_price as book_price')
                ->paginate(10);
            //dd($carts);
            return view('pages.cart', compact('carts'));
        } else {
            return redirect()->route('account')->with('warning', 'If you want to access your cart, you must login first!');
        }
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('warning', 'If you want to add something to cart, you must login first!');
        } else {
            $request->merge(['user_id' => Auth::id()]);
            $data = $request->all();
            try {
                Cart::create($data);
                return redirect()->back()->with('success', 'Added to cart successfully!');
            } catch (\Illuminate\Database\QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == '1062') {
                    return redirect()->back()->with('error', 'This book already exists in your cart!');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('warning', 'Server is busy, please try again later!');
            }
        }
    }

    public function update(Request $request)
    {
        //dd($request->all());
        try {
            if ($request->quantity == 0){
                DB::table('carts')
                    ->where('book_id', $request->book_id)
                    ->where('user_id', Auth::id())
                    ->delete();
            } else {
                Cart::where('book_id', $request->book_id)
                    ->where('user_id', Auth::id())
                    ->update(['quantity' => $request->quantity]);
            }
            return redirect()->back()->with('success', 'Updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Server is busy, please try again later!');
        }
    }

    public function destroy($book_id)
    {
        try {
            DB::table('carts')
                ->where('book_id', $book_id)
                ->where('user_id', Auth::id())
                ->delete();
            return redirect()->back()->with('success', 'Removed from cart successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Server is busy, please try again later!');
        }
    }

    public function getQuantity()
    {
        $cart = DB::table('carts')
            ->where('user_id', Auth::id())
            ->get();
        return $cart->count();
    }
}
