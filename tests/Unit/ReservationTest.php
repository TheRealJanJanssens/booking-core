<?php

use TheRealJanJanssens\BookingCore\Models\Reservation;
use TheRealJanJanssens\BookingCore\Models\Service;
use TheRealJanJanssens\BookingCore\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class)->group('Reservation', function() {
    // test('can create a reservation with relationships', function () {
    //     $service = Service::factory()->create();
    //     $provider = Provider::factory()->create();

    //     // Create a reservation with valid attributes
    //     $reservation = Reservation::create([
    //         'service_id' => $service->id,
    //         'provider_id' => $provider->id,
    //         'user_id' => rand(1, 999),
    //         'start_time' => now(),
    //         'end_time' => now()->addHour(),
    //         'status' => 'confirmed',
    //     ]);

    //     // Assert relationships
    //     expect($reservation->service)->toBeInstanceOf(Service::class)
    //         ->and($reservation->service_id)->toBe($service->id);

    //     expect($reservation->provider)->toBeInstanceOf(Provider::class)
    //         ->and($reservation->provider_id)->toBe($provider->id);

    //     // Assert date casting
    //     expect($reservation->start_time)->toBeInstanceOf(\DateTime::class);
    //     expect($reservation->end_time)->toBeInstanceOf(\DateTime::class);
    // });
});
