<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CoverageOption;

class CoverageOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoverageOption::insert([
            ['name' => 'Medical Expenses', 'price' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Trip Cancellation', 'price' => 30, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
