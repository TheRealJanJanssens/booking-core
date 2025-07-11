<?php

namespace TheRealJanJanssens\BookingCore\Traits\Models;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public static function bootTraits()
    {
        static::bootHasUuid();
    }
}
