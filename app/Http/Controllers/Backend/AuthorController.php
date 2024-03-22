<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Traits\CrudModel;

class AuthorController extends Controller
{
    use CrudModel;

    protected function model(): string
    {
        return Author::class;
    }

    protected function indexView(): string
    {
        return 'admin.author.author';
    }

    public function index()
    {
        return view('admin.author.author');
    }

    public function create()
    {
        return view('admin.author.create');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.author.edit', compact('author'));
    }
}
