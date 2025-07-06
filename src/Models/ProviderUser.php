<?php

namespace TheRealJanJanssens\BookingCore\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderUser extends Pivot
{
    use HasUuids, SoftDeletes;

    protected $table = 'provider_user';
    public $incrementing = false;
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(config('auth.defaults.model'));
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
