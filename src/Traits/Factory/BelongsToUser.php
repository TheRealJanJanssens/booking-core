<?php

namespace TheRealJanJanssens\BookingCore\Traits\Factory;

use App\Models\User;
use TheRealJanJanssens\BookingCore\Support\IdentifierResolver;

trait BelongsToUser
{
    public function belongsToUser($identifier = false) {
        if (!$identifier) {
            $user = User::inRandomOrder()->first();
            $identifier = $user->{User::getKeyName()};
        }

        return $this->state(function (array $attributes) use ($identifier) {
            return [
                IdentifierResolver::foreignKeyFor('user') => $identifier,
            ];
        });
    }
}
