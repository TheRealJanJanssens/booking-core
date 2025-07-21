<?php

namespace TheRealJanJanssens\BookingCore\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\BookingCore\Models\ProviderSchedule;
use TheRealJanJanssens\BookingCore\Traits\Factory\BelongsToScheduleGroup;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderScheduleFactory extends Factory
{
    use BelongsToScheduleGroup;

    protected $model = ProviderSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_at' => Carbon::now()->toTimeString(),
            'end_at' => Carbon::now()->addHours(7)->toTimeString(),
            'day_of_week' => rand(0,6)
        ];
    }
}
