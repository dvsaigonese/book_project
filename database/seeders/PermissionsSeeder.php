<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
//        Permission::create(['name' => 'create books']);
//        Permission::create(['name' => 'read books']);
//        Permission::create(['name' => 'update books']);
//        Permission::create(['name' => 'delete books']);
//
//        Permission::create(['name' => 'create news']);
//        Permission::create(['name' => 'read news']);
//        Permission::create(['name' => 'update news']);
//        Permission::create(['name' => 'delete news']);
//
//        Permission::create(['name' => 'create authors']);
//        Permission::create(['name' => 'read authors']);
//        Permission::create(['name' => 'update authors']);
//        Permission::create(['name' => 'delete authors']);
//
//        Permission::create(['name' => 'create genres']);
//        Permission::create(['name' => 'read genres']);
//        Permission::create(['name' => 'update genres']);
//        Permission::create(['name' => 'delete genres']);
//
//        Permission::create(['name' => 'create users']);
//        Permission::create(['name' => 'read users']);
//        Permission::create(['name' => 'update users']);
//        Permission::create(['name' => 'delete users']);
//
//        Permission::create(['name' => 'create sliders']);
//        Permission::create(['name' => 'read sliders']);
//        Permission::create(['name' => 'update sliders']);
//        Permission::create(['name' => 'delete sliders']);

//        Permission::create(['name' => 'create orders']);
//        Permission::create(['name' => 'read orders']);
//        Permission::create(['name' => 'update orders']);
//        Permission::create(['name' => 'delete orders']);
//
//        Permission::create(['name' => 'create roles']);
//        Permission::create(['name' => 'read roles']);
//        Permission::create(['name' => 'update roles']);
//        Permission::create(['name' => 'delete roles']);

//        Permission::create(['name' => 'read statistics']);

        // create roles and assign existing permissions

//        $role = Role::where('name', 'Super Admin')->get();
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
//        $user = \App\Models\User::factory()->create([
//            'name' => 'Super Admin',
//            'email' => 'superadmin@gmail.com',
//            'password' => Hash::make(123456), // password
//            'position_id' => 1,
//            'status' => 1,
//        ]);
//        $user=User::find(2);
//        $user->assignRole($role3);
    }
}
