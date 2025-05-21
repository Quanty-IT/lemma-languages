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
        $teacherId = auth('teacher')->id();

        $teacher = Teacher::find($teacherId);
        $teacherLanguages = $teacher->languages;  // Array de idiomas do professor

        // Buscar alunos do professor, incluindo os idiomas que o aluno quer aprender
        $students = Student::where('teacher_id', $teacherId)->get();

        // Passa $teacherLanguages para a view junto com os alunos
        return view('teacher.create', compact('students', 'teacherLanguages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|string',
            'hours' => 'required|integer|min:1|max:99',
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
        $teacherId = auth('teacher')->id();
        $teacher = Teacher::find($teacherId);
        $teacherLanguages = $teacher->languages;  // Idiomas do professor

        // Buscar o aluno da aula com seus idiomas
        $student = Student::find($lesson->student_id);

        return view('teacher.edit', compact('lesson', 'student', 'teacherLanguages'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'month' => 'required|string',
            'hours' => 'required|integer|min:1|max:99',
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
