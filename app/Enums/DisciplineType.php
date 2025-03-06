<?php

namespace App\Enums;

enum DisciplineType: string
{
    case POINT = 'point';
    case TIME = 'time';

    public function getOrder(?int $overrideOrder = null): int
    {
        if ($overrideOrder !== null) {
            return $overrideOrder; // Use custom order if provided
        }

        return match ($this) {
            self::POINT => 1,  // Default order for points
            self::TIME => 0,    // Default order for time
        };
    }
}
