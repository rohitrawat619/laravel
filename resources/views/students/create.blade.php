@extends('layouts.app')

@section('content')
<h1 class="text-center">Add New Student</h1>

<br>

<form id='sub'>
    @csrf
    @method('POST')
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
                <td><input type="text" name="student_name" id="student_name" required> </td>
                <td><select name="class_teacher_id" id="class_teacher_id" required>
                        @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="class" id="class" required></td>
                <td><input type="date" name="admission_date" id="admission_date" required></td>
                <td><input type="number" name="yearly_fees" id="yearly_fees" step="0.01" required></td>
                <td>
                    <button type="submit" class="btn btn-warning" value="submit">Save</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>

<div id="responseMessage"></div> <!-- Add this for displaying messages -->

<h6 class="text-center">
    <a href="{{ route('students.index') }}" class="btn btn-dark">Back to List</a>
</h6>


<script type="text/javascript">
    $(document).ready(function() {
        $('#sub').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            console.log(formData);  

            $.ajax({
                type: "POST",
                url: "{{ route('students.store') }}",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Show success message in alert
                    alert('Student added successfully');
                    // Optionally, reset the form or navigate to another page
                    $('#sub')[0].reset();
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '\n'; // Collect all errors
                    });
                    alert('Error: \n' + errorMessage); // Show errors in alert
                }
            });
        });
    });
</script>
