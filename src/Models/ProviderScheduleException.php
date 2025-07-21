<?php

namespace TheRealJanJanssens\BookingCore\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use TheRealJanJanssens\BookingCore\Traits\HasResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use TheRealJanJanssens\BookingCore\Database\Factories\ProviderScheduleExceptionFactory;
use TheRealJanJanssens\BookingCore\Enums\ProviderScheduleType;

class ProviderScheduleException extends Model
{
    use HasFactory, Notifiable, HasUuids, HasResolver;

    protected $primaryKey = 'uuid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_uuid',
        'start_at',
        'end_at',
        'type',
    ];

    protected $casts = [
        'type' => ProviderScheduleType::class,
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function provider()
    {
        return $this->belongsTo($this->resolve('provider'));
    }

    protected static function newFactory()
    {
        return ProviderScheduleExceptionFactory::new();
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
            'start_at' => "required",
            'end_at' => "required",
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'start_at' => "required",
            'end_at' => "required",
        ]);
    }
}
