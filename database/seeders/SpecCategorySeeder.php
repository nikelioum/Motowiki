<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SpecCategory;

class SpecCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SpecCategory::create(['name' => 'Engine']);
        SpecCategory::create(['name' => 'Frame']);
        SpecCategory::create(['name' => 'Brakes']);
    }
}
