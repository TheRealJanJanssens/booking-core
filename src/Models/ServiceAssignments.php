<?php

namespace TheRealJanJanssens\BookingCore\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use TheRealJanJanssens\BookingCore\Traits\Models\HasResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ServiceAssignments extends Model
{
    use HasFactory, Notifiable, HasUuids, HasResolver;

    protected $fillable = [
        'service_id',
        'provider_id',
    ];

    public function service()
    {
        return $this->belongsTo($this->resolve('service'));
    }

    public function provider()
    {
        return $this->belongsTo($this->resolve('provider'));
    }

    /*
    |------------------------------------------------------------------------------------
    | Validations
    | TODO: Move this
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'service_id' => "required",
            'provider_id' => "required",
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'service_id' => "required",
            'provider_id' => "required",
        ]);
    }
}
