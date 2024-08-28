@extends('layouts.app')

@section('content')
<h1 class="text-center">Students List</h1>
<div class="d-flex justify-content-center mt-2 mb-2">
<a href="{{ route('students.create') }}" class="btn btn-info mt-2 mb-2">Add New Student</a>
</div>
 
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
          @foreach ($students as $student)
          <tr>
               <td>{{ $student->student_name }}</td>
               <td>{{ $student->class }}</td>
               <td>{{ $student->admission_date }}</td>
               <td>{{ $student->yearly_fees }}</td>
               <td>
                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
               </td>
          </tr>
          @endforeach
     </tbody>
</table>
<br>

<form method="GET" action="{{ route('students.index') }}">
     <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
     <button type="submit">Search</button>
</form>

<ul>
     @forelse ($students as $student)
     @empty
     <p>No students found.</p>
     @endforelse
</ul>

<h6 class="text-center"> <a href="{{ route('students.index') }}" class="btn btn-dark ">Back to List</a> </h6>

{{ $students->appends(request()->query())->links('vendor.pagination.custom-pagination') }}


{{-- @php
    $rohit = ['1','2','3','4','5'];
@endphp

<ul>
@foreach ($rohit as $fuck)
@if($loop->first)
<li style="color: red">  {{ $fuck }} </li>
@elseif($loop->last)
<li style="color: yellow"> {{ $fuck }} </li>
@else
<li style="color: green"> {{ $fuck }} </li>
@endif
         
@endforeach
</ul> --}}

@endsection