<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\CrudModel;

class SliderController extends Controller
{
    use CrudModel;

    protected function model(): string
    {
        return Slider::class;
    }

    protected function indexView(): string
    {
        return 'admin.slider.slider';
    }

    public function index()
    {
        return view('admin.slider.slider');
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function statusUpdate(Request $request, $id)
    {
        $slider = Slider::find($id);
        $slider->status = $request->status;
        $slider->save();
        return redirect()->route('admin.slider.index')->with('toast', ['status' => 'success', 'message' => 'Updated Successfully!']);
    }
}
