<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $images  = [
            $this->faker->imageUrl(800, 600, 'cats'),
            $this->faker->imageUrl(800, 600, 'cats')
        ];

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->realText(),
            'price' => $this->faker->numberBetween(10, 100),
            'image' => $this->faker->imageUrl(800, 600, 'cats'),
            'images' => $images
        ];
    }
}
