<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListExams extends ListRecords
{
    protected static string $resource = ExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->label(__('All'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', '!=', 'archived')),
            'published' => Tab::make()
                ->label(__('Published'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'published')),
            'draft' => Tab::make()
                ->label(__('Draft'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'draft')),
            'archived' => Tab::make()
                ->label(__('Archived'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'archived')),
        ];
    }
}
