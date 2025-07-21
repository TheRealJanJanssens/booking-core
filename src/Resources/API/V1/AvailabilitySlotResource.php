<?php

namespace TheRealJanJanssens\BookingCore\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AvailabilitySlotResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'start_time' => $this['start'],
            'end_time' => $this['end'],
            'available' => $this['available'],
        ];
    }
}
