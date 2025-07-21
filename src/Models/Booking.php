<?php

namespace TheRealJanJanssens\BookingCore\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use TheRealJanJanssens\BookingCore\Database\Factories\BookingFactory;
use TheRealJanJanssens\BookingCore\Support\IdentifierResolver;
use TheRealJanJanssens\BookingCore\Traits\HasResolver;
use TheRealJanJanssens\BookingCore\Traits\Models\CreateUuid;

class Booking extends Model
{
    use HasFactory, Notifiable, HasUuids, CreateUuid, HasResolver;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'service_id',
        'provider_id',
        'user_id',
        'start_at',
        'end_at',
        'status',
        'notes'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo($this->resolve('service'));
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo($this->resolve('provider'));
    }

    public function user()
    {
        return $this->belongsTo($this->resolve('user'), IdentifierResolver::foreignKeyFor('user'));
    }

    protected static function newFactory()
    {
        return BookingFactory::new();
    }
}
