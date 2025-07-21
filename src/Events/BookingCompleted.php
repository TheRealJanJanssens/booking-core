<?php

namespace TheRealJanJanssens\BookingCore\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use TheRealJanJanssens\BookingCore\Contracts\Models\BookingContract;

class BookingCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public BookingContract $booking,
    ) {}
}
