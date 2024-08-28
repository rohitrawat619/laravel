<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::with('teacher');

        $query = $request->input('search');

        $students = Student::when($query, function ($queryBuilder, $search) {
            return $queryBuilder->where('student_name', '=', $search);
        })->paginate(4);

        // dd($students);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('students.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class_teacher_id' => 'required|exists:teachers,id',
            'class' => 'required|string|max:10',
            'admission_date' => 'required|date',
            'yearly_fees' => 'required|numeric'
        ]);

        Student::create($request->all());

        return redirect()->route('students.index');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $teachers = Teacher::all();
        return view('students.edit', compact('student', 'teachers'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class_teacher_id' => 'required|exists:teachers,id',
            'class' => 'required|string|max:10',
            'admission_date' => 'required|date',
            'yearly_fees' => 'required|numeric'
        ]);

        $student->update($request->all());

        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }
}
