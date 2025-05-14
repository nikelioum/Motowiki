<?php

namespace Database\Factories;

use App\Enum\SpecAttributeType;
use App\Models\Spec;
use App\Models\SpecCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spec>
 */
class SpecFactory extends Factory
{
    protected $model = Spec::class;

    public function definition(): array
    {
        return [
            'spec_category_id' => SpecCategory::factory(),
            'name' => $this->faker->unique()->slug(1),         // e.g., 'cc'
            'label' => $this->faker->words(2, true),           // e.g., 'Engine Capacity'
            'type' => $this->faker->randomElement(SpecAttributeType::values()), // enum value
        ];
    }
}
