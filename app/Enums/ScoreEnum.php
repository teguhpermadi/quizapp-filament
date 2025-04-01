<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ScoreEnum: string implements HasLabel
{
    case SCORE_1 = '1';
    case SCORE_2 = '2';
    case SCORE_3 = '3';
    case SCORE_4 = '4';
    case SCORE_5 = '5';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SCORE_1 => '1 point',
            self::SCORE_2 => '2 point',
            self::SCORE_3 => '3 point',
            self::SCORE_4 => '4 point',
            self::SCORE_5 => '5 point',
        };
    }
}
