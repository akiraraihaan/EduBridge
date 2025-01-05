<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'mentor'],
            ['name' => 'student']
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}
