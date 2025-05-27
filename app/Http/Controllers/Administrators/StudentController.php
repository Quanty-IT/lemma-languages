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
            'availability' => 'array',
            'language' => 'required|string',
            'goal' => 'required|string',
            'notes' => 'nullable|string|max:300',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        Student::create($data);
        return redirect()->route('administrator.students.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function show(Student $student)
    {
        $student->load('teacher');
        return view('administrator.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $teachers = Teacher::all();
        return view('administrator.students.edit', compact('student', 'teachers'));
    }

    public function update(Request $request, Student $student)
    {
        $request->merge(['phone' => sanitizePhoneNumber($request->input('phone'))]);

        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|max:11|unique:students,phone,' . $student->id,
            'email' => 'required|email|unique:students,email,' . $student->id,
            'availability' => 'required|array',
            'language' => 'required|string',
            'goal' => 'required|string',
            'notes' => 'nullable|string|max:300',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $student->update($data);
        return redirect()->route('administrator.students.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('administrator.students.index')->with('success', 'Aluno excluído com sucesso!');
    }
}
