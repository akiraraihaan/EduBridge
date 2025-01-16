<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua data yang ada di tabel roles
        Role::truncate();

        // $roles = [
        //     ['name' => 'admin'],
        //     ['name' => 'mentor'],
        //     ['name' => 'student']
        // ];

        // foreach ($roles as $role) {
        //     DB::table('roles')->insert($role);
        // }

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'mentor']);
        Role::create(['name' => 'student']);
    }
}
