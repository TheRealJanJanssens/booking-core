<?php

return [
    'api' => [
        // Shared prefix for all package API routes
        'prefix' => 'api/v1',

        // Middleware for non-auth routes
        'middleware' => ['api'],

        // Middleware for auth-protected routes
        'auth_middleware' => ['api', 'auth:sanctum'],
    ],

    'models' => [
        'user' => [
            'identifier' => 'id',
            'class' => \App\Models\User::class,
        ],
        'provider' => [
            'identifier' => 'uuid',
            'class' => \TheRealJanJanssens\BookingCore\Models\Provider::class,
        ],
        'provider_schedule_group' => [
            'identifier' => 'uuid',
            'class' => \TheRealJanJanssens\BookingCore\Models\ProviderScheduleGroup::class,
        ],
        'provider_schedule' => [
            'identifier' => 'uuid',
            'class' => \TheRealJanJanssens\BookingCore\Models\ProviderSchedule::class,
        ],
        'provider_schedule_exception' => [
            'identifier' => 'uuid',
            'class' => \TheRealJanJanssens\BookingCore\Models\ProviderScheduleException::class,
        ],
        'booking' => [
            'identifier' => 'uuid',
            'class' => \TheRealJanJanssens\BookingCore\Models\Booking::class,
        ],
        'service' => [
            'identifier' => 'uuid',
            'class' => \TheRealJanJanssens\BookingCore\Models\Service::class,
        ],
        'service_assignments' => [
            'identifier' => 'uuid',
            'class' => \TheRealJanJanssens\BookingCore\Models\ServiceAssignments::class,
        ],
    ],
];
