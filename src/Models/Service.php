<?php

namespace TheRealJanJanssens\BookingCore\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Service extends Model
{
    use HasUuids, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'description',
        'duration',
        'price'
    ];

    public function providers()
    {
        return $this->belongsToMany(Provider::class)
            ->withTimestamps()
            ->using(ServiceProvider::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
