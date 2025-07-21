<?php

namespace TheRealJanJanssens\BookingCore\Enums;

use TheRealJanJanssens\BookingCore\Traits\Enums\HasOptions;

enum ProviderScheduleType: string
{
    use HasOptions;

    case Available   = 'available';
    case Unavailable = 'unavailable';
    case Holiday     = 'holiday';

    public function isAvailable(): string
    {
        return match($this) {
            ProviderScheduleType::Available => true,
            ProviderScheduleType::Unavailable, ProviderScheduleType::Holiday => false,
        };
    }
}
