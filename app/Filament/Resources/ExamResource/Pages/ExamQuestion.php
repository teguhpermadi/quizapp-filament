<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Enums\StatusEnum;
use App\Filament\Resources\ExamResource;
use App\Models\Exam;
use App\Models\ExamQuestionParagraph;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class ExamQuestion extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithRecord;
    
    public ?array $data = [];
    public $titleName;

    protected static string $resource = ExamResource::class;

    protected static string $view = 'filament.resources.exam-resource.pages.exam-question';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        // ubah status menjadi draft
        $this->record->status = StatusEnum::DRAFT->value;
        $this->record->save();

        $this->form->fill([
            'titleName' => $this->record->title,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('titleName')
                    ->required(),
            ])
            ->statePath('data');
    }
}
