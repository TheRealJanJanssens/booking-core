<?php

namespace TheRealJanJanssens\BookingCore\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\BookingCore\Models\Reservation;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'id' => \Str::uuid(),
            'provider_id' => \TheRealJanJanssens\BookingCore\Models\Provider::factory(),
            'service_id' => \TheRealJanJanssens\BookingCore\Models\Service::factory(),
            'user_id' => \TheRealJanJanssens\BookingCore\Models\ProviderUser::factory(),
            'start_time' => now(),
            'end_time' => now()->addHour(),
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
