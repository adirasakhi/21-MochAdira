<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'penyewa',
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'roles' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
