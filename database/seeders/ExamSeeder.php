<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exam = Exam::factory(3)->create();
        $exam->each(function($exam){
            $questions = Question::get()->random(5);
            $exam->question()->attach($questions->pluck('id'));
        });
    }
}
