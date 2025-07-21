<?php

namespace TheRealJanJanssens\BookingCore\Traits\Factory;

use TheRealJanJanssens\BookingCore\Support\IdentifierResolver;
use TheRealJanJanssens\BookingCore\Traits\HasResolver;

trait BelongsToBase
{
    use HasResolver;

    public function belongsToBase($class, $identifier = false) {
        if (!$identifier) {
            $model = $this->resolveNew($class)->inRandomOrder()->first();
            $identifier = $model->getKeyName(); //FIXME this returns id instead of the actual id
        }

        return $this->state(function (array $attributes) use ($class, $identifier) {
            return [
                IdentifierResolver::foreignKeyFor($class) => $identifier,
            ];
        });
    }
}
