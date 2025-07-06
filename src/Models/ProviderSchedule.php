<?php

namespace TheRealJanJanssens\BookingCore\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use TheRealJanJanssens\BookingCore\Traits\Models\HasResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProviderSchedule extends Model
{
    use HasFactory, Notifiable, HasUuids, HasResolver;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id',
        'mon',
        'tue',
        'wed',
        'thu',
        'fri',
        'sat',
        'sun',
        'start_at',
        'end_at',
    ];

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
