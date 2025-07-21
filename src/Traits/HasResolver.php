<?php

namespace TheRealJanJanssens\BookingCore\Traits;

trait HasResolver
{
    public function resolve(string $modelKey): string
    {
        return config("booking-core.models.$modelKey.class");
    }

    public function resolveNew(string $modelKey, array $attributes = [])
    {
        $class = $this->resolve($modelKey);

        return new $class($attributes);
    }
}
