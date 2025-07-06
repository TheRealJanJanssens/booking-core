<?php

namespace TheRealJanJanssens\BookingCore\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use TheRealJanJanssens\BookingCore\Support\IdentifierResolver;
use TheRealJanJanssens\BookingCore\Traits\Models\HasResolver;

class Reservation extends Model
{
    use HasUuids, SoftDeletes, HasResolver;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'service_id',
        'provider_id',
        'user_id',
        'start_time',
        'end_time',
        'status',
        'notes'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
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
}
