<?php

namespace TheRealJanJanssens\BookingCore\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\BookingCore\Enums\ProviderType;
use TheRealJanJanssens\BookingCore\Models\Provider;
use TheRealJanJanssens\BookingCore\Traits\Factory\BelongsToUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    use BelongsToUser;

    protected $model = Provider::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'type' => ProviderType::randomOption(),
            'description' => fake()->text(),
            'capacity' => rand(1,3)
        ];
    }
}
