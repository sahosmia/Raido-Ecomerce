<?php

namespace Database\Seeders;

use App\Models\Cupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cupon::factory()->count(15)->create();
    }
}
