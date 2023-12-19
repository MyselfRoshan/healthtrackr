<?php

declare(strict_types=1);

namespace App\Enums;

enum ActivityCategory: int
{
    case Breakfast = 0;
    case Launch = 1;
    case Snack = 2;
    case Dinner = 3;

    public function toString(): string
    {
        return match ($this) {
            self::Breakfast  => 'Breakfast',
            self::Launch   => 'Launch',
            self::Snack => 'Snack',
            self::Dinner => 'Dinner'
        };
    }
}
