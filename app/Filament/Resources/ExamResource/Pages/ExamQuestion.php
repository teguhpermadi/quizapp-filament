<?php

namespace App\Filament\Resources\ExamResource\Pages;

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
    public $tes;

    public $exam, $questionsGrouped;

    protected static string $resource = ExamResource::class;

    protected static string $view = 'filament.resources.exam-resource.pages.exam-question';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->form->fill([
            'tes' => 'tes',
        ]);

        // check questions with paragraph
        $questionsHasParagraph = ExamQuestionParagraph::where('exam_id', $this->record->id)->has('paragraph')->with('paragraph', 'question.answers')->get()->groupBy('paragraph_id');

        // check questions without paragraph
        $questionsDoesntHaveParagraph = ExamQuestionParagraph::where('exam_id', $this->record->id)->doesnthave('paragraph')->with('question.answers')->get();

        // collect
        $format = collect();

        foreach ($questionsHasParagraph as $questionHasParagraph => $valueParagraph) {
            $data = (object) [
                'order' => $valueParagraph[0]['order'],
                'paragraph' => $valueParagraph[0]->paragraph, // get the first paragraph
                'questions' => $valueParagraph->pluck('question'),
            ];

            $format->push($data);
        }

        foreach ($questionsDoesntHaveParagraph as $questionDoesntHaveParagraph) {
            $data = (object) [
                'order' => $questionDoesntHaveParagraph->order,
                'paragraph' => null,
                'question' => $questionDoesntHaveParagraph->question,
            ];

            $format->push($data);
        }
       
        $this->questionsGrouped = $format->sortBy(['order', 'asc']);
        // \dd($this->questionsGrouped);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('tes')
                //     ->required(),
            ]);
    }
}
