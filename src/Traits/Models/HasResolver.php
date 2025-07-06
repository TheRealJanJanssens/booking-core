<?php

namespace TheRealJanJanssens\BookingCore\Traits\Models;

trait HasResolver
{
    public function resolve(string $modelKey): string
    {
        return config("booking-core.models.$modelKey");
    }

    public function resolveNew(string $modelKey, array $attributes = [])
    {
        $class = $this->resolve($modelKey);

        return new $class($attributes);
    }
}
