<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MotoCategory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MotoCategory>
 */
class MotoCategoryFactory extends Factory
{
    protected $model = MotoCategory::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->words(2, true);

        return [
            'title' => $title,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(640, 480, 'motorcycle', true),
            'slug' => Str::slug($title),
            'meta_title' => $title . ' - MotoWiki',
            'meta_description' => $this->faker->sentence,
            'meta_image' => $this->faker->imageUrl(640, 480, 'meta', true),
            'status' => $this->faker->boolean(90),
            'parent_id' => null,
        ];
    }
}
