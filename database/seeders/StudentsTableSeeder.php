<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        Student::create([
            'student_name' => 'Alice Johnson',
            'class_teacher_id' => 1,
            'class' => '10A',
            'admission_date' => '2024-08-01',
            'yearly_fees' => 5000.00
        ]);
        Student::create([
            'student_name' => 'Bob Brown',
            'class_teacher_id' => 2,
            'class' => '10B',
            'admission_date' => '2024-08-01',
            'yearly_fees' => 5500.00
        ]);
    }
}
