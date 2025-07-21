<?php

namespace TheRealJanJanssens\BookingCore\Models;


use TheRealJanJanssens\BookingCore\Traits\Models\CreateUuid;
use TheRealJanJanssens\BookingCore\Traits\HasResolver;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use TheRealJanJanssens\BookingCore\Contracts\Models\ProviderContract;
use TheRealJanJanssens\BookingCore\Database\Factories\ProviderFactory;
use TheRealJanJanssens\BookingCore\Support\IdentifierResolver;

class Provider extends Model implements ProviderContract
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
        'capacity',
        'type',
        'description'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo($this->resolve('user'), IdentifierResolver::foreignKeyFor('user'));
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany($this->resolve('service'), 'service_assignments', 'provider_uuid', 'service_uuid')->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany($this->resolve('booking'));
    }

    protected static function newFactory()
    {
        return ProviderFactory::new();
    }
}
