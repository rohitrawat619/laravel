<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    // List all Records
    public function index()
    {
        return Record::all();
    }

    // Store a new Record
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        return Record::create($request->all());
    }

    // Show a specific Record
    public function show(Record $Record)
    {
        return $Record;
    }

    // Update an existing Record
    public function put(Request $request, Record $record)
    {
    // Validate the incoming request data
    $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'content' => 'sometimes|required',
    ]);

    // Update the record with the validated data
    $record->update($request->all()); // Full update
    return response()->json($record);
}

// Update an existing Record
public function patch(Request $request, Record $record)
    {
    // Validate the incoming request data
    $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'content' => 'sometimes|required',
    ]);

    // Update the record with the validated data
    $record->update($request->only(['title'])); // Partial update
    return response()->json($record);
}

    // Delete a Record
    public function destroy($id)
    {
        $record = Record::find($id);
    
        if ($record) {
            $record->delete();  // Soft delete (this will set deleted_at timestamp)
            return response()->json(['message' => 'Record soft deleted successfully.']);
        }
    
        return response()->json(['message' => 'Record not found.'], 404);
    }
}
