<?php

namespace App\Livewire;

use App\Models\ExamQuestionParagraph;
use Livewire\Component;

class ExamQuestionLivewire extends Component
{
    public $exam, $questionsGrouped;

    public function mount($exam)
    {
        // check questions with paragraph
        $questionsHasParagraph = ExamQuestionParagraph::where('exam_id', $exam->id)
                                    ->has('paragraph')
                                    ->with('paragraph', 'question.answers')
                                    ->get()
                                    ->groupBy('paragraph_id');

        // check questions without paragraph
        $questionsDoesntHaveParagraph = ExamQuestionParagraph::where('exam_id', $exam->id)
                                    ->doesnthave('paragraph')
                                    ->with('question.answers')
                                    ->get();

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
        $this->exam = $exam;
    }

    public function render()
    {
        return view('livewire.exam-question-livewire', [
            'exam' => $this->exam,
            'questionsGrouped' => $this->questionsGrouped,
        ]);
    }
}
