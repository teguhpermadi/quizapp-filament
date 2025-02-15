<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //get all students then give them grades
        $students = Student::all();
        $grades = Grade::all();

        $students->each(function ($student) use ($grades) {
            $student->grades()->attach(
                $grades->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
