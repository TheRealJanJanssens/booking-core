<?php

namespace TheRealJanJanssens\BookingCore\Support;

class IdentifierResolver
{
    public static function identifier(string $model): string
    {
        return config('booking-core.'.$model.'_identifier', 'id');
    }

    public static function foreignKeyFor(string $model): string
    {
        return $model . '_' . static::identifier($model);
    }

    public static function usesUuid($model): bool
    {
        return static::identifier($model) === 'uuid';
    }

    // this methods needs work or needs to be removed
    public static function resolveKeyFor(string $model): string
    {
        return (new $model)->getKeyName();
    }
}
