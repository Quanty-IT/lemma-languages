<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson;
use App\Models\Teacher;
use App\Models\Student;

class LessonController extends Controller
{
    public function create()
    {
        // ID do professor logado
        $teacherId = auth('teacher')->id();

        // Buscar os idiomas que o professor pode ensinar
        $teacher = Teacher::find($teacherId);
        $availableLanguages = $teacher->languages;

        // Buscar todos os alunos associados ao professor logado
        $students = Student::where('teacher_id', $teacherId)->get();

        return view('teacher.create', compact('students', 'availableLanguages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|string',
            'hours' => 'required|integer|min:1',
            'content' => 'required|string',
            'student_id' => 'required|exists:students,id',
            'language' => 'required|string',
        ]);

        // Adiciona o ID do professor ao registro
        $validated['teacher_id'] = auth('teacher')->id();

        // Cria o novo registro de aula
        Lesson::create($validated);
        return redirect()->route('teacher.home')->with('success', 'Aula registrada com sucesso!');
    }

    public function show(Student $student)
    {
        // Garante que o aluno pertence ao professor logado
        if ($student->teacher_id !== Auth::id()) abort(403, 'Acesso negado.');

        $lessons = $student->lessons;
        return view('teacher.show', compact('student', 'lessons'));
    }

    public function edit(Lesson $lesson)
    {
        // ID do professor logado
        $teacherId = auth('teacher')->id();

        // Buscar todos os alunos associados ao professor logado
        $students = Student::where('teacher_id', $teacherId)->get();

        // Buscar os idiomas que o professor pode ensinar
        $teacher = Teacher::find($teacherId);
        $availableLanguages = $teacher->languages;

        return view('teacher.edit', compact('lesson', 'students', 'availableLanguages'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'month' => 'required|string',
            'hours' => 'required|numeric',
            'content' => 'required|string',
            'language' => 'required|string',
        ]);

        $lesson->update($validated);
        return redirect()->route('teacher.show', ['student' => $lesson->student_id])->with('success', 'Aula atualizada com sucesso.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->back()->with('success', 'Aula excluída com sucesso.');
    }
}
