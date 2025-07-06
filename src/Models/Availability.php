<?php

namespace TheRealJanJanssens\BookingCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Availability extends Model
{
    use HasUuids;

    protected $table = 'availability';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'provider_id',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
