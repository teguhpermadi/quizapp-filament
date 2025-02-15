<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Userable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::factory()
            ->count(10)
            ->hasUserable(1, function (array $attributes, Teacher $teacher) {
                return ['user_id' => User::factory()->create()->id];
            })
            ->create();

        // give each teacher role
        $teachers->each(function (Teacher $teacher) {        
            $teacher->userable->user->assignRole('teacher');
        });
    }
}
