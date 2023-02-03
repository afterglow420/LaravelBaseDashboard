<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingModel>
 */
class BookingModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'booking_name' => $this->faker->name(),
            'booking_start' => $this->faker->dateTimeBetween('-1 week', 'now'), 
            'booking_end' => $this->faker->dateTimeBetween('now', '+3 days'),
            'booking_details' => $this->faker->words(6, true),
        ];
    }
}
