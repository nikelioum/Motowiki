<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bike;
use App\Models\MotoBrand;
use App\Models\MotoCategory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bike>
 */
class BikeFactory extends Factory
{
    protected $model = Bike::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'brand_id' => MotoBrand::factory(),
            'category_id' => MotoCategory::factory(),
            'year' => $this->faker->numberBetween(2000, 2025),
            'price' => $this->faker->randomFloat(2, 1000, 30000),
            'image' => $this->faker->imageUrl(640, 480, 'motorcycle', true),
            'description' => $this->faker->paragraph,
            'meta_title' => $name . ' - MotoWiki',
            'meta_description' => $this->faker->sentence,
            'meta_image' => $this->faker->imageUrl(640, 480, 'meta', true),
            'status' => $this->faker->boolean(90),
        ];
    }
}
