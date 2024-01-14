<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::create([
            'name' => 'user',
            'display_name' => 'USER',
            'description' => 'User Role'
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'ADMIN',
            'description' => 'Admin Role'
        ]);

        $sadminRole = Role::create([
            'name' => 'sadmin',
            'display_name' => 'SUPER ADMIN',
            'description' => 'Super Admin Role'
        ]);

        $admin = User::create([
            'name' => 'venny',
            'email' => null,
            'username' => 'venny',
            'password' => bcrypt('only4Venny'),
            'access_password' => 'only4Venny',
        ]);

        $sadmin = User::create([
            'name' => 'sadmin',
            'email' => null,
            'username' => 'sadmin',
            'password' => bcrypt('just4Sadmin'),
            'access_password' => 'just4Sadmin',
        ]);

        $sadmin->attachRole($sadminRole);
        $admin->attachRole($adminRole);
    }
}
