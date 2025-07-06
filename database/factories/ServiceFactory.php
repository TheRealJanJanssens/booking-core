<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\BookingCore\Models\Service;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->text,
            'duration' => $this->faker->numberBetween(30, 180),
            'price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
