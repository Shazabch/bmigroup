<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name'  => 'Admin',
            'email' => 'admin1@admin.com',
            'password' =>bcrypt('password'),
        ];
        Admin::insert($admin);

        $user = [
            'name'  => 'user',
            'email' => 'user1@user.com',
            'password' =>bcrypt('password'),
        ];
        User::insert($user);



    }
}
