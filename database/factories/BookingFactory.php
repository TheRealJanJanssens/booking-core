<?php

namespace TheRealJanJanssens\BookingCore\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\BookingCore\Enums\BookingStatus;
use TheRealJanJanssens\BookingCore\Models\Booking;
use TheRealJanJanssens\BookingCore\Traits\Factory\BelongsToProvider;
use TheRealJanJanssens\BookingCore\Traits\Factory\BelongsToService;
use TheRealJanJanssens\BookingCore\Traits\Factory\BelongsToUser;

class BookingFactory extends Factory
{
    use BelongsToUser, BelongsToProvider, BelongsToService;

    protected $model = Booking::class;

    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'start_at' => now()->getTimestamp(),
            'end_at' => now()->addHour()->getTimestamp(),
            'status' => BookingStatus::randomOption(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
