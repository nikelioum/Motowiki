<?php

namespace Database\Factories;

use App\Models\Vendor;
use App\Models\MotoBrand as Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $states = [
            'Αττική',
            'Κεντρική Μακεδονία',
            'Δυτική Μακεδονία',
            'Θεσσαλία',
            'Ήπειρος',
            'Ιόνια Νησιά',
            'Δυτική Ελλάδα',
            'Στερεά Ελλάδα',
            'Peloponnisos',
            'Βόρειο Αιγαίο',
            'Νότιο Αιγαίο',
            'Κρήτη'
        ];

        return [
            'name' => $this->faker->company,
            'brand_id' => Brand::inRandomOrder()->first()->id,  // Randomly assign a brand
            'image' => $this->faker->imageUrl(640, 480, 'business', true),  // Fake image URL
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'state' => $this->faker->randomElement($states),
        ];
    }
}
