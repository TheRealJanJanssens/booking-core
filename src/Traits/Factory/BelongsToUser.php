<?php

namespace TheRealJanJanssens\BookingCore\Traits\Factory;

trait BelongsToUser
{
    use BelongsToBase;

    public function belongsToUser($identifier = false) {
        return $this->belongsToBase('user', $identifier);
    }
}
