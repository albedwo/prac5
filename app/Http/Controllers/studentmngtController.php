<?php

namespace App\Http\Controllers;
use App\Models\student;
use Illuminate\Http\Request;

class studentmngtController extends Controller
{
    public function index () {
        $students = student::all();
        return view ('student.index', compact('students'));
    }

    public function create () {
        return view ('student.create');
    }
    public function store (Request $request) {
        $request->validate([
            'name' => 'required',
            'age' => 'required|integer',
            'email' => 'required|email|unique:students,email',
        ]);

        student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }
    public function edit ($id) {
        $student = student::findOrFail($id);
        return view ('student.edit', compact('student'));
    }
    public function update (Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'age' => 'required|integer',
            'email' => 'required|email|unique:students,email,' . $id,
        ]);

        $student = student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }
    public function destroy ($id) {
        $student = student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');   
    }
}
