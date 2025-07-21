<?php

namespace TheRealJanJanssens\BookingCore\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AvailabilityDayResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'date' => $this->date,
            'slots' => AvailabilitySlotResource::collection($this->slots),
        ];
    }
}
