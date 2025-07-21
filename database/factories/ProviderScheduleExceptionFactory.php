<?php

namespace TheRealJanJanssens\BookingCore\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\BookingCore\Enums\ProviderScheduleType;
use TheRealJanJanssens\BookingCore\Models\ProviderScheduleException;
use TheRealJanJanssens\BookingCore\Traits\Factory\BelongsToProvider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderScheduleExceptionFactory extends Factory
{
    use BelongsToProvider;

    protected $model = ProviderScheduleException::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'start_at' => Carbon::now()->toDateTimeString(),
            'end_at' => Carbon::now()->addDays(7)->toDateTimeString(),
            'type' => ProviderScheduleType::randomOption()
        ];
    }
}
