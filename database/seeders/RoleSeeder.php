<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::create([
            "name"          => "User",
            'guard_name'    => 'web',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        $superAdminRole = Role::create([
            "name"          => "Super Admin",
            'guard_name'    => 'web',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        $user = User::create([
            "role_id"       => $userRole->id,
            "name"          => "Arie Satria",
            "email"         => "arie@arieshop.com",
            "password"      => Hash::make("password"),
            "picture_path"  => null
        ]);

        $superAdmin = User::create([
            "role_id"       => $superAdminRole->id,
            "name"          => "Admin",
            "email"         => "admin@arieshop.com",
            "password"      => Hash::make("password"),
            "picture_path"  => null
        ]);

        $user->assignRole($userRole);
        $superAdmin->assignRole($superAdminRole);
    }
}
