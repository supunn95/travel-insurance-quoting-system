<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Destination::insert([
            ['name' => 'Europe', 'price' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Asia', 'price' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'America', 'price' => 30, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
