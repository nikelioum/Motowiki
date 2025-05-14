<?php

namespace Database\Seeders;

use App\Models\BikeSpecValue;
use Illuminate\Database\Seeder;

class BikeSpecValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 10 random BikeSpecValues
        BikeSpecValue::factory()->count(10)->create();
    }
}
