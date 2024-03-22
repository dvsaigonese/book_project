<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Traits\CrudModel;
use Illuminate\Http\Request;

class NewsBEController extends Controller
{
    use CrudModel;

    protected function model(): string
    {
        return News::class;
    }

    protected function indexView(): string
    {
        return 'admin.news.news';
    }

    public function index(){
        return view('admin.news.news');
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $imagePath = '';

        if ($request->hasFile('image_file')) {
            $imageName = time() . '.' . $request->image_file->extension();

            $request->image_file->move(public_path('images'), $imageName);

            $imagePath = 'images/' . $imageName;
        }

        $request->merge(['image' => $imagePath]);

        News::create($request->all());

        return view($this->indexView())->with('toast', ['status' => 'success', 'message' => 'Created Successfully!']);

    }

    public function edit($id)
    {
        $news = News::find($id);
        return view('admin.news.edit', compact('news'));
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
