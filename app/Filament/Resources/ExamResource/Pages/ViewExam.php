<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewExam extends ViewRecord
{
    protected static string $resource = ExamResource::class;

    protected static string $view = 'filament.resources.exam-resource.pages.view-exam';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\Action::make('edit question')
            //     ->label('Edit Question')
            //     ->url(function () {
            //         return $this->getResource()::getUrl('question', ['record' => $this->getRecord()]);
            //     }),
            Actions\EditAction::make(),
        ];
    }
}
