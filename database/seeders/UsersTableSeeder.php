<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Variable untuk role
        $adminRoleId = DB::table('roles')->where('roles', 'admin')->first()->id;
        $penyewaRoleId = DB::table('roles')->where('roles', 'penyewa')->first()->id;

        // Seed admin user
        DB::table('users')->insert([
            'fullname' => 'Admin User',
            'nik' => '1234567890123456',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'address' => '123 Admin Street',
            'password' => Hash::make('password'),
            'role_id' => $adminRoleId,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed penyewa user
        DB::table('users')->insert([
            'fullname' => 'Penyewa User',
            'nik' => '6543210987654321',
            'email' => 'penyewa@example.com',
            'email_verified_at' => now(),
            'address' => '456 Penyewa Avenue',
            'password' => Hash::make('12345678'),
            'role_id' => $penyewaRoleId,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
