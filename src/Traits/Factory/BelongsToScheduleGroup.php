<?php

namespace TheRealJanJanssens\BookingCore\Traits\Factory;

trait BelongsToScheduleGroup
{
    use BelongsToBase;

    public function belongsToScheduleGroup($identifier = false) {
        return $this->belongsToBase('provider_schedule_group', $identifier);
    }
}
