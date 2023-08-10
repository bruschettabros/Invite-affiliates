<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Affiliate>
 */
class AffiliateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => sprintf('%s %s', $this->faker->firstName, $this->faker->lastName),
            'lat' => $this->faker->latitude,
            'lon' => $this->faker->longitude,
            'affiliate_id' => $this->faker->randomNumber(3, true)
        ];
    }
}
