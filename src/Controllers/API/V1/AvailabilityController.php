<?php

namespace TheRealJanJanssens\BookingCore\Controllers\API\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use TheRealJanJanssens\BookingCore\Requests\API\V1\AvailabilityRequest;
use TheRealJanJanssens\BookingCore\Resources\API\V1\AvailabilityDayResource;
use TheRealJanJanssens\BookingCore\Services\ProviderAvailabilityService;
use TheRealJanJanssens\BookingCore\Traits\HasResolver;

class AvailabilityController extends Controller
{
    use HasResolver;

    /**
     * Display a list of available time slots.
     */
    public function __invoke(AvailabilityRequest $request)
    {
        $validated = $request->validated();

        $availability = (new ProviderAvailabilityService())->getFormattedAvailabilitySlots(
            provider: $this->resolve('provider')::find($validated['provider']),
            service: $this->resolve('service')::find($validated['service']),
            startDate: Carbon::parse($validated['start_date']),
            endDate: Carbon::parse($validated['end_date'] ?? $validated['start_date'])
        );

        return AvailabilityDayResource::collection($availability);
    }
}
