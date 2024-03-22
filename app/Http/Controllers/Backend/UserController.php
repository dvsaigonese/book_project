<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use App\Traits\CrudModel;

class UserController extends Controller
{
    use CrudModel;

    protected function model(): string
    {
        return User::class;
    }

    protected function indexView(): string
    {
        return 'admin.user.user';
    }

    public function index()
    {
        return view('admin.user.user');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $positions = Position::all();
        return view('admin.user.edit', compact(['user', 'positions']));
    }
}


