<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;

class TeacherController extends Controller
{

    public function home()
    {
        $students = Auth::guard('teacher')->user()->students;
        return view('teacher.home', compact('students'));
    }

    public function index()
    {
        $teachers = Teacher::all();
        return view('administrator.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('administrator.teachers.create');
    }

    public function store(Request $request)
    {
        // Limpa o telefone antes de validar
        $rawPhone = preg_replace('/\D/', '', $request->input('phone'));
        $request->merge(['phone' => $rawPhone]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11|unique:teachers,phone',
            'email' => 'required|email|unique:teachers,email',
            'availability' => 'required|array',
            'languages' => 'required|array',
            'hourly_rate' => 'required|numeric|min:0',
            'commission' => 'required|numeric',
            'pix' => 'required|string|unique:teachers,pix',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Gera a senha padrão
        $firstName = ucfirst(strtolower(explode(' ', trim($request->name))[0]));
        $generatedPassword = $firstName . '@1234';

        Teacher::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'availability' => $data['availability'],
            'languages' => $data['languages'],
            'hourly_rate' => $data['hourly_rate'],
            'commission' => $data['commission'],
            'pix' => $data['pix'],
            'notes' => $data['notes'],
            'password' => Hash::make($generatedPassword),
        ]);

        return redirect()->route('administrator.teachers.index')->with('success', 'Cadastro concluído');
    }

    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('administrator.teachers.show', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('administrator.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        // Limpa o telefone antes de validar
        $rawPhone = preg_replace('/\D/', '', $request->input('phone'));
        $request->merge(['phone' => $rawPhone]);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11|unique:teachers,phone,' . $teacher->id,
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'availability' => 'required|array',
            'languages' => 'required|array',
            'hourly_rate' => 'required|numeric|min:0',
            'commission' => 'required|numeric',
            'pix' => 'required|string|unique:teachers,pix' . $teacher->id,
            'notes' => 'nullable|string|max:1000',
        ]);

        $teacher->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'availability' => $request->input('availability'),
            'languages' => $request->input('languages'),
            'hourly_rate' => $request->input('hourly_rate'),
            'commission' => $request->input('commission'),
            'pix' => $request->input('pix'),
            'notes' => $request->input('notes'),
        ]);

        return redirect()->route('administrator.teachers.index')->with('success', 'Alterações salvas');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return redirect()->route('administrator.teachers.index')->with('success', 'Cadastro excluído');
    }

    public function filter(Request $request)
    {
        $languages = $request->input('languages', []);
        $availability = $request->input('availability', []);

        $query = Teacher::query();

        if (!empty($languages)) {
            $query->where(function ($q) use ($languages) {
                foreach ($languages as $lang) {
                    $q->orWhereJsonContains('languages', $lang);
                }
            });
        }

        if (!empty($availability)) {
            $query->where(function ($q) use ($availability) {
                foreach ($availability as $slot) {
                    $q->orWhereJsonContains('availability', $slot);
                }
            });
        }

        $teachers = $query->get(['id', 'name']);
        return response()->json($teachers);
    }
}
