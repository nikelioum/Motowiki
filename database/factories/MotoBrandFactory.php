<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MotoBrand;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MotoBrand>
 */
class MotoBrandFactory extends Factory
{
    protected $model = MotoBrand::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->company;

        return [
            'name' => $name,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(640, 480, 'motorcycle', true),
            'slug' => Str::slug($name),
            'meta_title' => $name . ' - MotoWiki',
            'meta_description' => $this->faker->sentence,
            'meta_image' => $this->faker->imageUrl(640, 480, 'meta', true),
            'status' => $this->faker->boolean(90),
        ];
    }
}
