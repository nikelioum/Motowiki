<?php

namespace Database\Seeders;

use App\Enum\SpecAttributeType;
use App\Models\Spec;
use App\Models\SpecCategory;
use Illuminate\Database\Seeder;

class SpecSeeder extends Seeder
{
    public function run(): void
    {
        // Example spec categories
        $engineCategory = SpecCategory::firstOrCreate(['name' => 'Engine']);
        $frameCategory = SpecCategory::firstOrCreate(['name' => 'Frame']);

        // Engine specs
        Spec::create([
            'spec_category_id' => $engineCategory->id,
            'name' => 'cc',
            'label' => 'Engine Capacity',
            'type' => SpecAttributeType::Integer->value,
        ]);

        Spec::create([
            'spec_category_id' => $engineCategory->id,
            'name' => 'horsepower',
            'label' => 'Horsepower',
            'type' => SpecAttributeType::Float->value,
        ]);

        // Frame specs
        Spec::create([
            'spec_category_id' => $frameCategory->id,
            'name' => 'width',
            'label' => 'Width',
            'type' => SpecAttributeType::Float->value,
        ]);

        Spec::create([
            'spec_category_id' => $frameCategory->id,
            'name' => 'height',
            'label' => 'Height',
            'type' => SpecAttributeType::Float->value,
        ]);
    }
}
