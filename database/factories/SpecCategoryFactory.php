<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SpecCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecCategory>
 */
class SpecCategoryFactory extends Factory
{
    protected $model = SpecCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
