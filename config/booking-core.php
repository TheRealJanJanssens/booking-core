<?php

return [
    'models' => [
        'user'                => \App\Models\User::class,
        'provider'            => \TheRealJanJanssens\BookingCore\Models\Provider::class,
        'provider_schedule'   => \TheRealJanJanssens\BookingCore\Models\ProviderSchedule::class,
        'reservation'         => \TheRealJanJanssens\BookingCore\Models\Reservation::class,
        'service'             => \TheRealJanJanssens\BookingCore\Models\Service::class,
        'service_assignments' => \TheRealJanJanssens\BookingCore\Models\ServiceAssignments::class,
    ],
];
