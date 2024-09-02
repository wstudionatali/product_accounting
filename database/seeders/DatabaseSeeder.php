<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     */
    public function run(): void
    {
    /**
     * Seed tables user_roles and users with 1-st admin data
     */

    $admin_id = DB::table('user_roles')->insertGetId(
        [
        'role' =>  env('ADMINISTRATOR', 'admin'),
        ],
        );
    DB::table('user_roles')->insert([
        [
        'role' =>  env('STOREKEEPER', 'storekeeper'),
            ],
        [
        'role' =>  env('SALES_MANAGER', 'sales_manager'),
        ],
        [
        'role' =>  env('SALESMAN', 'salesman'),
        ],
    ]);

    User::factory()->create([
        'name' => 'Natalia',
        'email' => 'wstudionatali@gmail.com',
        'password' => Hash::make('admin'),
        'user_role_id' => $admin_id,
    ]);

    }
}
