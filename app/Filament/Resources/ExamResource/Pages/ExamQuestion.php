<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
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
    public $questions;

    protected static string $resource = ExamResource::class;

    protected static string $view = 'filament.resources.exam-resource.pages.exam-question';

    public function mount(int | string $record): void 
    {
        $this->record = $this->resolveRecord($record);
        
        $this->form->fill([
            'title' => $this->record->title,
        ]);

        $this->questions = $this->record->question;
    }
 
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),
            ])
            ->statePath('data');
    } 
}
