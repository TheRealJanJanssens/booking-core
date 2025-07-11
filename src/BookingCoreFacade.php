<?php

namespace TheRealJanJanssens\BookingCore;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TheRealJanJanssens\Pakka\Pakka
 */
class BookingCoreFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'booking-core';
    }
}
