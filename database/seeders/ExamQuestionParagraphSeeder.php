<?php

namespace Database\Seeders;

use App\Enums\QuestionTypeEnum;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamQuestionParagraph;
use App\Models\Paragraph;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamQuestionParagraphSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create exam
        $exam = Exam::factory()->count(1)->create();

        // create multiple choice question
        $multiple_choice_questions = Question::factory()
            ->state([
                'question_type' => QuestionTypeEnum::MULTIPLE_CHOICE,
            ])
            ->has(Answer::factory()
                ->multipleChoice()
                ->count(1)
                ->state([
                    'is_correct' => true
                ]))
            ->has(Answer::factory()
                ->multipleChoice()
                ->count(3)
                ->state([
                    'is_correct' => false
                ]))
            ->count(5)
            ->create();

        // multiple answers question
        $multiple_answer_questions = Question::factory()
            ->state([
                'question_type' => QuestionTypeEnum::MULTIPLE_ANSWER,
            ])
            ->has(Answer::factory()
                ->multipleChoice()
                ->count(2)
                ->state([
                    'is_correct' => true
                ]))
            ->has(Answer::factory()
                ->multipleChoice()
                ->count(2)
                ->state([
                    'is_correct' => false
                ]))
            ->count(5)
            ->create();

        // true false question
        $true_false_questions = Question::factory()
            ->state([
                'question_type' => QuestionTypeEnum::TRUE_FALSE,
            ])
            ->has(Answer::factory()
                ->trueFalse()
                ->state([
                    'answer_text' => 'True',
                    'is_correct' => true
                ])
                ->count(1))
            ->has(Answer::factory()
                ->trueFalse()
                ->state([
                    'answer_text' => 'False',
                    'is_correct' => false
                ])
                ->count(1))
            ->count(5)
            ->create();

        // attach question, paragraph to exam
        $paragraph_1 = Paragraph::factory()->count(1)->create()->first()->id;
        $count = 1;
        foreach ($multiple_choice_questions as $multiple_choice_question) {
            // $exam->first()->questions()->attach(
            //     $multiple_choice_question->id,
            //     ['paragraph_id' => $paragraph_1,
            //     'order' => $count]
            // );
            ExamQuestionParagraph::create([
                'exam_id' => $exam->first()->id,
                'question_id' => $multiple_choice_question->id,
                'paragraph_id' => $paragraph_1,
                'order' => $count
            ])->save();
            $count++;
        }


        foreach ($true_false_questions as $true_false_question) {
            // $exam->first()->questions()->attach(
            //     $true_false_question->id,
            //     ['order' => $count]
            // );
            ExamQuestionParagraph::create([
                'exam_id' => $exam->first()->id,
                'question_id' => $true_false_question->id,
                'order' => $count
            ])->save();
            $count++;
        }

        // attach multiple answer questions to exam
        $paragraph_2 = Paragraph::factory()->count(1)->create()->first()->id;
        foreach ($multiple_answer_questions as $multiple_answer_question) {
            // $exam->first()->questions()->attach(
            //     $multiple_answer_question->id,
            //     ['paragraph_id' => $paragraph_2,
            //     'order' => $count]
            // );
            ExamQuestionParagraph::create([
                'exam_id' => $exam->first()->id,
                'question_id' => $multiple_answer_question->id,
                'paragraph_id' => $paragraph_2,
                'order' => $count
            ])->save();
            $count++;
        }
    }
}
