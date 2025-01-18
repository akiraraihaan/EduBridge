<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Batch::create([
            'name' => 'Batch 1',
            'start_date' => '2025-01-01',
            'end_date' => '2025-01-01',
            'capacity' => 1000,
            'enrolled_count' => Course::sum('student_count'),
            'is_open' => true,
            'is_active' => true
        ]);
    }
}
