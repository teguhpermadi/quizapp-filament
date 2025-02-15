<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $teacher = Role::updateOrCreate(['name' => 'teacher']);
        $student = Role::updateOrCreate(['name' => 'student']);
    }
}
