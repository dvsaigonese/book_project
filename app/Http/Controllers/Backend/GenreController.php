<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Traits\CrudModel;

class GenreController extends Controller
{
    use CrudModel;

    protected function model(): string
    {
        return Genre::class;
    }

    protected function indexView(): string
    {
        return 'admin.genre.genre';
    }

    public function index()
    {
        return view('admin.genre.genre');
    }

    public function create()
    {
        return view('admin.genre.create');
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('admin.genre.edit', compact('genre'));
    }
}
