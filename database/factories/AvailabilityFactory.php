<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\BookingCore\Models\Availability;

class AvailabilityFactory extends Factory
{
    protected $model = Availability::class;

    public function definition()
    {
        return [
            'provider_id' => \TheRealJanJanssens\BookingCore\Models\Provider::factory(),
            'start_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_time' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['start_time'], '+1 month');
            },
        ];
    }
}
