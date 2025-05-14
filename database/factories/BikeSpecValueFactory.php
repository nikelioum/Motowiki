<?php

namespace Database\Factories;

use App\Models\Bike;
use App\Models\Spec;
use Illuminate\Database\Eloquent\Factories\Factory;

class BikeSpecValueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'bike_id' => Bike::factory(), // Will create a bike if one doesn't exist
            'spec_id' => Spec::factory(), // Will create a spec if one doesn't exist
            'value' => $this->faker->randomElement([
                $this->faker->numberBetween(50, 1000),
                $this->faker->randomFloat(2, 0, 500),
                $this->faker->word,
                $this->faker->boolean ? 'yes' : 'no',
            ]),
        ];
    }
}

