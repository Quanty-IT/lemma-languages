<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('teacher')->get(); // Eager load the teacher
        return view('administrator.students.index', compact('students'));
    }
    

    public function create()
    {
        $teachers = Teacher::all();
        return view('administrator.students.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'availability' => 'array',
            'languages' => 'array',
            'goal' => 'nullable|string',
            'observation' => 'nullable|string',
            'teacher_id' => 'required|exists:teachers,id', // Validação do ID do professor
        ]);

        $student = Student::create($data); // Passa o array $data diretamente

        return redirect()->route('administrator.students.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function show(Student $student)
    {
        $student->load('teacher'); // Carrega os dados do professor
        return view('administrator.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $teachers = Teacher::all();
        return view('administrator.students.edit', compact('student', 'teachers'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'availability' => 'array',
            'languages' => 'array',
            'goal' => 'nullable|string',
            'observation' => 'nullable|string',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $student->update($data); // Passa o array $data diretamente
        return redirect()->route('administrator.students.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('administrator.students.index')->with('success', 'Aluno excluído com sucesso!');
    }
}