<?php

namespace TheRealJanJanssens\BookingCore\Models;

use TheRealJanJanssens\BookingCore\Traits\Models\CreateUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use TheRealJanJanssens\BookingCore\Traits\Models\HasResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use TheRealJanJanssens\BookingCore\Database\Factories\ServiceFactory;

class Service extends Model
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
        'price'
    ];

    public function providers(): BelongsToMany
    {
        return $this->belongsToMany($this->resolve('provider'), 'provider_services', 'service_uuid', 'provider_uuid')->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasMany($this->resolve('reservation'));
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
