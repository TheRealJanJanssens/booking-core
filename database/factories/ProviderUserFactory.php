<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use TheRealJanJanssens\BookingCore\Models\ProviderUser;

class ProviderUserFactory extends Factory
{
    protected $model = ProviderUser::class;

    public function definition()
{
    return [
        'id' => Str::uuid(),
        'user_id' => \TheRealJanJanssens\BookingCore\Models\ProviderUser::factory(),
        'provider_id' => \TheRealJanJanssens\BookingCore\Models\Provider::factory(),
        'created_at' => now(),
        'updated_at' => now(),
    ];
}
}
