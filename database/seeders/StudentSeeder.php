<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::factory()
            ->count(10)
            ->hasUserable(1, function (array $attributes, Student $student) {
                return ['user_id' => User::factory()->create()->id];
            })
            ->create();

        // give each student role
        $students->each(function (Student $student) {
            $student->userable->user->assignRole('student');
        });
    }
}
