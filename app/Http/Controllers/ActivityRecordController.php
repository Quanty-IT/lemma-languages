<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityRecord;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ActivityRecordController extends Controller
{
    public function create()
    {
        $teacherId = auth('teacher')->id();
        $students = Student::where('teacher_id', $teacherId)->get();

        return view('teacher.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|string',
            'hours' => 'required|integer|min:1',
            'content' => 'required|string',
            'student_id' => 'required|exists:students,id',
        ]);

        $validated['teacher_id'] = auth('teacher')->id();

        ActivityRecord::create($validated);

        return redirect()->route('teacher.home')->with('success', 'Registro salvo com sucesso!');
    }

    public function show(Student $student)
    {
        // Garante que o aluno pertence ao professor logado
        if ($student->teacher_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $activityRecords = $student->activityRecords;

        return view('teacher.show', compact('student', 'activityRecords'));
    }

    public function edit(ActivityRecord $record)
    {
        return view('teacher.edit', compact('record'));
    }

    public function update(Request $request, ActivityRecord $record)
    {
        $validated = $request->validate([
            'month' => 'required|string',
            'hours' => 'required|numeric',
            'content' => 'required|string',
        ]);

        $record->update($validated);

        return redirect()->route('students.show', $record->student_id)->with('success', 'Registro atualizado com sucesso.');
    }

    public function destroy(ActivityRecord $record)
    {

        $record->delete();
        return redirect()->back()->with('success', 'Registro excluído com sucesso.');
    }
}
