<?php

namespace TheRealJanJanssens\BookingCore\Database\Factories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\BookingCore\Models\Provider;
use TheRealJanJanssens\BookingCore\Models\Service;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $times = [
            '00:30:00',
            '01:00:00',
            '01:30:00',
            '02:00:00',
            '02:30:00'
        ];

        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'price' => rand(0,50),
            'duration' => $times[rand(0,4)],
            //'metadata' => json_encode([]) //TODO: Populate this?
        ];
    }

    public function withProviders(Collection|Provider $providers)
    {
        if($providers instanceof Collection){
            $providerIds = $providers->map(function($item){
                return $item->uuid;
            });
        }else{
            $providerIds = [$providers->uuid];
        }

        return $this->afterCreating(function (Service $service) use ($providerIds) {
            $service->providers()->attach($providerIds);
        });
    }
}
