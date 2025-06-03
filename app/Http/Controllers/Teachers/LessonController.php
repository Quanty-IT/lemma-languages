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
    public function create($id)
    {
        $student = Student::findOrFail($id);

        if ($student->teacher_id !== auth('teacher')->id()) {
            abort(403, 'Acesso negado.');
        }

        $teacher = Teacher::find(auth('teacher')->id());
        $teacherLanguages = $teacher->languages;

        return view('teacher.create', compact('student', 'teacherLanguages'));
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

        $validated['teacher_id'] = auth('teacher')->id();

        Lesson::create($validated);
        return redirect()->route('teacher.home')->with('success', 'Aula registrada com sucesso!');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        if ($student->teacher_id !== auth('teacher')->id()) {
            abort(403, 'Acesso negado.');
        }

        $lessons = $student->lessons;

        return view('teacher.show', compact('student', 'lessons'));
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);

        if ($lesson->teacher_id !== auth('teacher')->id()) {
            abort(403, 'Acesso negado.');
        }

        $teacher = Teacher::find(auth('teacher')->id());
        $teacherLanguages = $teacher->languages;

        $student = Student::find($lesson->student_id);

        return view('teacher.edit', compact('lesson', 'student', 'teacherLanguages'));
    }

    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

        if ($lesson->teacher_id !== auth('teacher')->id()) {
            abort(403, 'Acesso negado.');
        }

        $validated = $request->validate([
            'month' => 'required|string',
            'hours' => 'required|integer|min:1|max:99',
            'content' => 'required|string',
            'language' => 'required|string',
        ]);

        $lesson->update($validated);

        return redirect()->route('teacher.show', ['id' => $lesson->student_id])
            ->with('success', 'Aula atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);

        if ($lesson->teacher_id !== auth('teacher')->id()) {
            abort(403, 'Acesso negado.');
        }

        $lesson->delete();

        return redirect()->back()->with('success', 'Aula excluída com sucesso.');
    }
}
