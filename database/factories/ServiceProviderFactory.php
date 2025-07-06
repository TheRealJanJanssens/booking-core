<?php

namespace TheRealJanJanssens\BookingCore\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\BookingCore\Models\ServiceProvider;

class ServiceProviderFactory extends Factory
{
    protected $model = ServiceProvider::class;

    public function definition()
    {
        return [
            'service_id' => \TheRealJanJanssens\BookingCore\Models\Service::factory(),
            'provider_id' => \TheRealJanJanssens\BookingCore\Models\Provider::factory(),
        ];
    }
}
