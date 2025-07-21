<?php

namespace TheRealJanJanssens\BookingCore\Traits\Factory;

trait BelongsToProvider
{
    use BelongsToBase;

    public function belongsToProvider($identifier = false) {
        return $this->belongsToBase('provider', $identifier);
    }
}
