<?php

use App\Models\Exam;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/exam/{id}', function ($id) {
    $exam = Exam::with(['questions', 'paragraphs'])->findOrFail($id);

    $questionsGrouped = $exam->questions->groupBy('pivot.paragraph_id');

    $output = "{$exam->title}\n\n";
    $count = 1;

    foreach ($questionsGrouped as $paragraphId => $questions) {
        if ($paragraphId) {
            $paragraph = $exam->paragraphs->find($paragraphId);
            if ($paragraph) {
                $output .= "{$paragraph->paragraph}\n\n";
            }
        }

        foreach ($questions as $question) {
            $output .= "{$count}. {$question->question}\n";
            $count++;
        }
    }

    return nl2br($output); // Konversi newline ke <br> agar tampil dengan baik di browser
});