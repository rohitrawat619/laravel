@extends('layouts.app')

@section('content')

<div class="container text-center mt-2">
    <h1>Student Details</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Class</th>
                <th>Admission Date</th>
                <th>Yearly Fees</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->admission_date }}</td>
                <td>{{ $student->yearly_fees }}</td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

    <h6> <a href="{{ route('students.index') }}" class="btn btn-dark">Back to List</a> </h6>

    @endsection
</div>