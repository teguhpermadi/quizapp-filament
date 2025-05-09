<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\CommonMark\Node\Block\Paragraph;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            GradeSeeder::class,
            SubjectSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            StudentGradeSeeder::class,
            LessonSeeder::class,
            TeacherSubjectGradeLessonSeeder::class,
            ExerciseSeeder::class,
            // QuestionSeeder::class,
            // AnswerSeeder::class,
            // ParagraphSeeder::class,
            // ExamSeeder::class,
            ExamQuestionParagraphSeeder::class,
        ]);
    }
}
