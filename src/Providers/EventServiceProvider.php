<?php

namespace TheRealJanJanssens\BookingCore\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use TheRealJanJanssens\BookingCore\Events\BookingCompleted;
use TheRealJanJanssens\BookingCore\Listeners\ClearAvailabilityCache;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BookingCompleted::class => [
            ClearAvailabilityCache::class,
        ],
    ];
}
