<?php

namespace TheRealJanJanssens\BookingCore\Enums;

use TheRealJanJanssens\BookingCore\Traits\Enums\HasOptions;

enum ProviderType: string
{
    use HasOptions;

    case Person   = 'person';
    case Location = 'location';
    case Vehicle  = 'vehicle';
}
