<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\BookingCore\Models\Provider;

class ProviderFactory extends Factory
{
    protected $model = Provider::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'type' => $this->faker->word,
            'description' => $this->faker->text,
        ];
    }
}
