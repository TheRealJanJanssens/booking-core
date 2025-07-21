<?php

namespace TheRealJanJanssens\BookingCore\Support;

use Carbon\Carbon;

class TimeSlotGenerator
{
    public function __construct(
        protected int $duration,
        protected int $buffer,
        protected string $timezone,
        protected bool $ignoreBufferStart = false,
        protected bool $ignoreBufferEnd = false,
    ) {}

    public function generate(Carbon $date, string $startTime, string $endTime): array
    {
        $slots = [];

        $start = Carbon::parse($date->toDateString() . ' ' . $startTime, $this->timezone);
        $end = Carbon::parse($date->toDateString() . ' ' . $endTime, $this->timezone);

        $bufferBefore = $this->ignoreBufferStart ? 0 : $this->buffer;
        $bufferAfter = $this->ignoreBufferEnd ? 0 : $this->buffer;

        while ($start->copy()->addMinutes($this->duration + $bufferAfter)->lte($end)) {
            $slotStart = $start->copy()->addMinutes($bufferBefore);
            $slotEnd = $slotStart->copy()->addMinutes($this->duration);

            $slots[] = [
                'start' => $slotStart->toIso8601String(),
                'end' => $slotEnd->toIso8601String(),
            ];

            $start->addMinutes($this->duration + $this->buffer);
        }

        return $slots;
    }

    /**
     * markSlotAvailabilityi
     *
     * This function is crucial in marking slots as unavailble if slots intersects with checkItems
     * For future reference try to keep it this way that it only marks it as false since it is the safest way to calculate this
     * Potential improvement is using array_intersect here?
     */
    public function markSlotAvailability(array $slots, $checkItems): array
    {
        return collect($slots)->map(function ($slot) use ($checkItems) {
            $slotStart = Carbon::parse($slot['start']);
            $slotEnd = Carbon::parse($slot['end']);

            // If already marked unavailable, preserve it
            if (isset($slot['available']) && $slot['available'] === false) {
                return $slot;
            }

            $available = true;

            foreach ($checkItems as $checkItem) {
                $itemStart = Carbon::parse($checkItem->start_at);
                $itemEnd = Carbon::parse($checkItem->end_at);

                if ($slotStart < $itemEnd && $slotEnd > $itemStart) {
                    $available = false;
                    break; // stop checking further
                }
            }

            $slot['available'] = $available;

            return $slot;
        })->values()->all();
    }

}
