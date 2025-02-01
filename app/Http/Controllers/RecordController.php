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
    public function update(Request $request, Record $Record)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required',
        ]);

        $Record->update($request->all());

        return $Record;
    }

    // Delete a Record
    public function destroy(Record $Record)
    {
        $Record->delete();

        return response()->noContent();
    }
}
