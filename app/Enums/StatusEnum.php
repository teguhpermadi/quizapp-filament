<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel
{
    case PUBLISHED = 'published';
    case DRAFT = 'draft';
    case ARCHIVED = 'archived';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PUBLISHED => 'Published',
            self::DRAFT => 'Draft',
            self::ARCHIVED => 'Archived',
        };
    }
}
