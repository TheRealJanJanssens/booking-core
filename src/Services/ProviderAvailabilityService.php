<?php

namespace TheRealJanJanssens\BookingCore\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use TheRealJanJanssens\BookingCore\Contracts\Models\ProviderContract;
use TheRealJanJanssens\BookingCore\Contracts\Models\ServiceContract;
use TheRealJanJanssens\BookingCore\Support\TimeSlotGenerator;
use TheRealJanJanssens\BookingCore\Traits\HasResolver;

class ProviderAvailabilityService
{
    use HasResolver;

    protected array $models;

    public function __construct()
    {
        $this->models = config('booking-core.models');
    }

    public function getAvailabilitySlots(ProviderContract $provider, ServiceContract $service, Carbon $startDate, Carbon $endDate): array
    {
        $slots = [];
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $dateStr = $date->toDateString();
            $cacheKey = $this->generateCacheKey($provider->uuid, $service->uuid, $dateStr);

            $slots[$dateStr] = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($provider, $service, $date) {
                return $this->calculateDaySlots($provider, $service, $date);
            });
        }

        return $slots;
    }

    public function getFormattedAvailabilitySlots(ProviderContract $provider, ServiceContract $service, Carbon $startDate, Carbon $endDate): Collection {
        $availability = $this->getAvailabilitySlots($provider, $service, $startDate, $endDate);

        return collect($availability)->map(function ($slots, $date) {
            return (object) [
                'date' => $date,
                'slots' => collect($slots),
            ];
        })->values();
    }

    protected function calculateDaySlots(ProviderContract $provider, ServiceContract $service, Carbon $date): array
    {
        $daySlots = [];
        $dayOfWeek = $date->dayOfWeek;
        $dateStr = $date->toDateString();
        $dayStart = $date->copy()->startOfDay(); //->timezone($timezone)
        $dayEnd = $date->copy()->endOfDay(); //->timezone($timezone)
        $timezone = $provider->timezone ?? config('app.timezone');

        // Fetch all exceptions for the day
        $Exception = $this->resolve('provider_schedule_exception');
        $exceptions = $Exception::where('provider_uuid', $provider->uuid)
            ->whereDate('start_at', '<=', $dateStr)
            ->whereDate('end_at', '>=', $dateStr)
            ->get();

        // Classify exceptions
        $closedRanges = [];
        $openRanges = [];

        foreach ($exceptions as $exception) {
            if ($exception->type->isAvailable()) {
                $openRanges[] = [$exception->start_at, $exception->end_at];
            }else{
                $closedRanges[] = $exception;
            }
        }

        // Initialize slot generator
        $generator = new TimeSlotGenerator(
            duration: $service->duration_in_minutes,
            buffer: $service->buffer ?? config('booking-core.default_buffer_minutes', 0),
            timezone: $timezone,
            ignoreBufferStart: $service->ignore_buffer_start ?? false,
            ignoreBufferEnd: $service->ignore_buffer_end ?? false,
        );

        // If there are open exceptions, only use those as available ranges
        if (!empty($openRanges)) {
            foreach ($openRanges as [$start, $end]) {
                $daySlots = array_merge($daySlots, $generator->generate($date, $start->format("H:i"), $end->format("H:i")));
            }
        } else {
            // Use regular weekly schedule or fallback
            $ScheduleGroup = $this->resolve('provider_schedule_group');
            $Schedule = $this->resolve('provider_schedule');

            $group = $ScheduleGroup::where('provider_uuid', $provider->uuid)
                ->whereDate('start_at', '<=', $date)
                ->whereDate('end_at', '>=', $date)
                ->first();

            if ($group) {
                $weeklySchedules = $Schedule::where('provider_schedule_group_uuid', $group->uuid)
                    ->where('day_of_week', $dayOfWeek)
                    ->get();

                foreach ($weeklySchedules as $schedule) {
                    $daySlots = array_merge($daySlots, $generator->generate($date, $schedule->start_at, $schedule->end_at));
                }
            } else {
                //TODO: Make the default schedule configurable on tenant level
                $daySlots = $generator->generate($date, '09:00:00', '17:00:00');
            }
        }

        // Remove any slots that overlap with closed exceptions
        if (!empty($closedRanges)) {
            $daySlots = $generator->markSlotAvailability($daySlots, $closedRanges);
        }

        // Fetch bookings for the day
        $Booking = $this->resolve('booking');
        $bookings = $Booking::where('provider_uuid', $provider->uuid)
            ->where('start_at', '<', $dayEnd)
            ->where('end_at', '>', $dayStart)
            ->get();

        // Mark availability on each slot
        return $generator->markSlotAvailability($daySlots, $bookings);
    }

    protected function generateCacheKey(string $providerUuid, string $serviceUuid, string $date): string
    {
        return "availability:{$providerUuid}:{$serviceUuid}:{$date}";
    }

    public function clearCacheFor(string $providerUuid, string $serviceUuid, string $date): void
    {
        Cache::forget($this->generateCacheKey($providerUuid, $serviceUuid, $date));
    }
}
