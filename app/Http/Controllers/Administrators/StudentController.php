<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('teacher')->get();
        return view('administrator.students.index', compact('students'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('administrator.students.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->merge(['phone' => sanitizePhoneNumber($request->input('phone'))]);

        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|max:11|unique:students,phone',
            'email' => 'required|email|unique:students,email',
            'language' => 'required|string',
            'availability' => 'required|array',
            'goal' => 'required|string',
            'notes' => 'nullable|string|max:300',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        Student::create($data);
        return redirect()->route('administrator.students.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function show($id)
    {
        $student = Student::with('teacher')->findOrFail($id);
        return view('administrator.students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $teachers = Teacher::all();
        return view('administrator.students.edit', compact('student', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $request->merge(['phone' => sanitizePhoneNumber($request->input('phone'))]);

        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|max:11|unique:students,phone,' . $student->id,
            'email' => 'required|email|unique:students,email,' . $student->id,
            'language' => 'required|string',
            'availability' => 'required|array',
            'goal' => 'required|string',
            'notes' => 'nullable|string|max:300',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $student->update($data);
        return redirect()->route('administrator.students.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('administrator.students.index')->with('success', 'Aluno excluído com sucesso!');
    }
}
