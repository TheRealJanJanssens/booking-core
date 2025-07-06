<?php

namespace TheRealJanJanssens\BookingCore\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Provider extends Model
{
    use HasUuids, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'type',
        'description'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class)
            ->withTimestamps()
            ->using(ServiceProvider::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function user()
    {
        return $this->hasMany(config('auth.defaults.model'));
    }
}
