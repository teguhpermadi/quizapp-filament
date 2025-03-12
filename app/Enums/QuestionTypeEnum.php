<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum QuestionTypeEnum: string implements HasLabel
{
    case MULTIPLE_ANSWER = 'multiple answer';
    case MULTIPLE_CHOICE = 'multiple choice';
    case SHORT_ANSWER = 'short answer';
    case ESSAY = 'essay';
    case TRUE_FALSE = 'true false';
    case MATCHING = 'matching';
    case CALCULATE = 'calculate';
    case ORDERING = 'ordering';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::MULTIPLE_ANSWER => 'Multiple Answer',
            self::MULTIPLE_CHOICE => 'Multiple Choice',
            self::SHORT_ANSWER => 'Short Answer',
            self::ESSAY => 'Essay',
            self::TRUE_FALSE => 'True False',
            self::MATCHING => 'Matching',
            self::CALCULATE => 'Calculate',
            self::ORDERING => 'Ordering',
        };
    }
}
