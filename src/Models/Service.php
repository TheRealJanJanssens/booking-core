<?php

namespace TheRealJanJanssens\BookingCore\Models;

use Carbon\Carbon;
use TheRealJanJanssens\BookingCore\Traits\Models\CreateUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use TheRealJanJanssens\BookingCore\Traits\HasResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use TheRealJanJanssens\BookingCore\Contracts\Models\ServiceContract;
use TheRealJanJanssens\BookingCore\Database\Factories\ServiceFactory;

class Service extends Model implements ServiceContract
{
    use HasFactory, Notifiable, HasUuids, CreateUuid, HasResolver;

    protected $primaryKey = 'uuid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'duration',
        'price',
        'metadata'
    ];

    protected $appends = ['duration_in_minutes'];

    // Accessor
    public function getDurationInMinutesAttribute(): int
    {
        $time = $this->attributes['duration'] ?? '00:00:00';

        $carbon = Carbon::parse($time);
        return $carbon->hour * 60 + $carbon->minute;
    }

    public function providers(): BelongsToMany
    {
        return $this->belongsToMany($this->resolve('provider'), 'service_assignments', 'service_uuid', 'provider_uuid')->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany($this->resolve('booking'));
    }

    protected static function newFactory()
    {
        return ServiceFactory::new();
    }

    /*
    |------------------------------------------------------------------------------------
    | Validations
    | TODO: move this
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'name' => "required",
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'name' => "required",
        ]);
    }
}
