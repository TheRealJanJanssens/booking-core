<?php

namespace TheRealJanJanssens\BookingCore\Requests\API\V1;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Implement logic if needed
        return true;
    }

    public function rules(): array
    {
        return [
            'provider' => ['required', 'uuid'],
            'service' => ['required', 'uuid'],
            'start_date' => ['required', 'date_format:d-m-Y'],
            'end_date' => ['nullable', 'date_format:d-m-Y'],
        ];
    }
}
