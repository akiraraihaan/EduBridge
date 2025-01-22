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

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'mentor']);
        Role::create(['name' => 'student']);
    }
}
