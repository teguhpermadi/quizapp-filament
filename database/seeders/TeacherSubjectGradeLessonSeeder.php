<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSubjectGradeLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::factory()->count(10)->create();
        $grades = Grade::factory()->count(10)->create();
        $subjects = Subject::factory()->count(10)->create();
        $lessons = Lesson::factory()->count(10)->create();

        // Assign teachers to subjects and grades
        $teachers->each(function ($teacher) use ($subjects, $grades) {
            $teacher->subjects()->attach(
                $subjects->random()->id,
                ['grade_id' => $grades->random()->id]
            );
        });

        // Assign teachers, subjects, and grades to lessons
        $teachers->each(function ($teacher) use ($subjects, $grades, $lessons) {
            $teacher->lessons()->attach(
                $lessons->random()->id,
                [
                    'subject_id' => $subjects->random()->id,
                    'grade_id' => $grades->random()->id,
                ]
            );
        });
    }
}
