<?php

namespace TheRealJanJanssens\BookingCore\Traits\Enums;

use Illuminate\Support\Arr;

trait HasOptions
{
    public static function options(): array
    {
        $cases = static::cases();

        foreach($cases as $case){
            $result[$case->value] = $case->label();
        }

        return $result;
    }

    public static function optionsWithoutLabel(): array
    {
        $cases = static::cases();

        foreach($cases as $case){
            $result[] = $case->value;
        }

        return $result;
    }

    public static function randomOption(): string
    {
        return Arr::random(static::cases())->value;
    }
}
