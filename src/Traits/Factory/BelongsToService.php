<?php

namespace TheRealJanJanssens\BookingCore\Traits\Factory;

trait BelongsToService
{
    use BelongsToBase;

    public function belongsToService($identifier = false) {
        return $this->belongsToBase('service', $identifier);
    }
}
