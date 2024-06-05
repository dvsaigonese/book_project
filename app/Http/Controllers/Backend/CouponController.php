<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Traits\CrudModel;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    use CrudModel;

    protected function model(): string
    {
        return Coupon::class;
    }

    protected function indexView(): string
    {
        return 'admin.coupon.coupon';
    }

    public function index()
    {
        return view('admin.coupon.coupon');
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }
}
