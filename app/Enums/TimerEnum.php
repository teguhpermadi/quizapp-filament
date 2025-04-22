<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TimerEnum: string implements HasLabel
{
    case TIMER_5 = '500';
    case TIMER_10 = '1000';
    case TIMER_15 = '1500';
    case TIMER_20 = '2000';
    case TIMER_30 = '3000';
    case TIMER_60 = '6000';
    case TIMER_90 = '9000';
    case TIMER_120 = '12000';
    case TIMER_180 = '18000';
    case TIMER_300 = '30000';
    case TIMER_600 = '60000';
    case TIMER_900 = '90000';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TIMER_5 => '5 seconds',
            self::TIMER_10 => '10 seconds',
            self::TIMER_15 => '15 seconds',
            self::TIMER_20 => '20 seconds',
            self::TIMER_30 => '30 seconds',
            self::TIMER_60 => '1 minute',
            self::TIMER_90 => '1.5 minutes',
            self::TIMER_120 => '2 minutes',
            self::TIMER_180 => '3 minutes',
            self::TIMER_300 => '5 minutes',
            self::TIMER_600 => '10 minutes',
            self::TIMER_900 => '15 minutes',
        };
    }
}
