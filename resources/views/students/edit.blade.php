@extends('layouts.app')

@section('content')
<h1 class="text-center">Edit Student</h1>

<br>
<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Class Teacher</th>
                <th>Class</th>
                <th>Admission Date</th>
                <th>Yearly Fees</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="student_name" id="student_name" value="{{ $student->student_name }}" required>
                </td>
                <td><select name="class_teacher_id" id="class_teacher_id" required>
                        @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $student->class_teacher_id == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                        @endforeach
                    </select></td>
                <td><input type="text" name="class" id="class" value="{{ $student->class }}" required></td>
                <td><input type="date" name="admission_date" id="admission_date" value="{{ $student->admission_date }}" required></td>
                <td><input type="number" name="yearly_fees" id="yearly_fees" value="{{ $student->yearly_fees }}" step="0.01" required></td>
                <td>
                    <button type="submit" class="btn btn-warning">Update</button>
</form>
</td>
</tr>
</tbody>
</table>

<h6 class="text-center">
    <a href="{{ route('students.index') }}" class="btn btn-dark">Back to List</a>
</h6>

@endsection