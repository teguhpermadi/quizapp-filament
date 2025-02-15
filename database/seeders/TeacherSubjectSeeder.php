<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create teacher then give them subjects
        $teachers = Teacher::all();
        $subjects = Subject::all();

        foreach ($teachers as $teacher) {
            $teacher->subjects()->attach($subjects->random());
        }
    }
}
