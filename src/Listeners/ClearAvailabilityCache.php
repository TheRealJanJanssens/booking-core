<?php

namespace TheRealJanJanssens\BookingCore\Listeners;

use TheRealJanJanssens\BookingCore\Events\BookingCompleted;
use TheRealJanJanssens\BookingCore\Services\ProviderAvailabilityService;

class ClearAvailabilityCache
{
    public function handle(BookingCompleted $event)
    {
        $booking = $event->booking;
        $service = $booking->service;
        $provider = $booking->provider;

        $date = \Carbon\Carbon::parse($booking->start_at)->toDateString();

        app(ProviderAvailabilityService::class)->clearCacheFor(
            $provider->uuid,
            $service->uuid,
            $date
        );
    }
}
