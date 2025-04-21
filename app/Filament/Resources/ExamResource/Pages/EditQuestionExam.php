<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Enums\QuestionTypeEnum;
use App\Enums\ScoreEnum;
use App\Enums\TimerEnum;
use App\Filament\Resources\ExamResource;
use App\Models\Question;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;

class EditQuestionExam extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = ExamResource::class;

    protected static string $view = 'filament.resources.exam-resource.pages.edit-question-exam';

    public $exam, $question_id, $question, $question_type, $score, $timer;

    public function mount($record, $exam): void
    {
        $this->exam = $exam;
        $question = Question::find($record);
        $this->form->fill([
            'question_id' => $question->id,
            'question' => $question->question,
            'question_type' => $question->question_type,
            'score' => $question->score,
            'timer' => $question->timer,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('question_id'),
                Grid::make()
                    ->schema([
                        Select::make('question_type')
                            ->label('Question Type')
                            ->options(QuestionTypeEnum::class)
                            ->required(),
                        Select::make('score')
                            ->options(ScoreEnum::class)
                            ->required(),
                        Select::make('timer')
                            ->label('Timer')
                            ->options(TimerEnum::class)
                            ->required(),
                    ])
                    ->columns([
                        'sm' => 3,
                        'md' => 3,
                        'lg' => 3,
                        'xl' => 3,
                        '2xl' => 3,
                    ]),
                Grid::make()
                    ->schema([
                        Textarea::make('question')
                            ->label('Question')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public function submit()
    {
        $data = $this->form->getState();
        $question = Question::find($data['question_id']);
        $question->question = $data['question'];
        $question->question_type = $data['question_type'];
        $question->score = $data['score'];
        $question->timer = $data['timer'];
        $question->save();

        $this->redirect(ExamResource::getUrl('edit', ['record' => $this->exam]) . '#question-' . $question->id, navigate: true);
        // redirect to anchor

    }
}
