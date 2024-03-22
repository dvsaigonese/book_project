<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderFEController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderByDesc('created_at')->paginate(10);
        return view('pages.order', compact('orders'));
    }

    public function orderStatusFilter($status)
    {
        $orders = Order::where('user_id', auth()->user()->id)->where('order_status', $status)->orderByDesc('created_at')->paginate(10);
        return view('pages.order', compact('orders'));
    }

    public function orderTimeFilter(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $orders = Order::where('user_id', auth()->user()->id)
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->orderByDesc('created_at')
            ->paginate(10);
           // dd($from, $to, $orders);
        return view('pages.order', compact('orders', 'from', 'to'));
    }
}
