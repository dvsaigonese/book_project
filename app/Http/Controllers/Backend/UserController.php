<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
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
        $roles = Role::all();
        $user_has_roles = DB::table('model_has_roles')
            ->where('model_id', '=', $id)
            ->get();

        return view('admin.user.edit', compact(['user', 'roles', 'user_has_roles']));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());

            DB::table('model_has_roles')
                ->where('model_id', $id)
                ->delete();

            $user_has_roles = DB::table('model_has_roles')
                ->where('model_id', '=', $id)
                ->get();

            foreach ($user_has_roles as $user_roles) {
                $item = Role::find($user_roles->model_id);
                $user->removeRole($item);
            }

            foreach ($request->get('roles') as $role) {
                $item = Role::find($role);
                $user->assignRole($item);
            }

            return view('admin.user.user')->with('toast', ['status' => 'success', 'message' => 'Updated Successfully!']);

        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Server is busy, please try again later!');
        }
    }
}


