<?php

namespace TheRealJanJanssens\BookingCore\Enums;

use TheRealJanJanssens\BookingCore\Traits\Enums\HasOptions;

enum BookingStatus: string
{
    use HasOptions;

    case Pending     = 'pending';
    case Confirmed   = 'confirmed';
    case Cancelled   = 'cancelled';
    case Rescheduled = 'rescheduled';
}
