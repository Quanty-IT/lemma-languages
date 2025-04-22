<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
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
        $request->validate([
            'name' => 'required|string|max:255|unique:teachers,name',
            'phone' => 'required|string|max:14|unique:teachers,phone',
            'email' => 'required|email|unique:teachers,email',
            'availability' => 'nullable|array',
            'languages' => 'required|array',
            'hourly_rate' => 'required|numeric',
            'commission' => 'required|numeric',
            'pix' => 'required|string|unique:teachers,pix',
            'notes' => 'nullable|string|max:1000',
        ]);

        $generatedPassword = $request->name . '@1234';

        $availability = implode(',', $request->input('availability', []));
        $languages = implode(',', $request->input('languages', []));

        Teacher::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'availability' => $availability,
            'languages' => $languages,
            'hourly_rate' => $request->input('hourly_rate'),
            'commission' => $request->input('commission'),
            'pix' => $request->input('pix'),
            'notes' => $request->input('notes'),
            'password' => Hash::make($generatedPassword),
        ]);

        return redirect()->route('administrator.teachers.index')->with('success', 'Cadastro concluído');
    }

    public function show($id) // Exibe os dados de um professor 
    {
        $teacher = Teacher::findOrFail($id);
        return view('administrator.teachers.show', compact('teacher'));
    }

    public function edit($id) // Exibe o form pra editar um professor
    {
        $teacher = Teacher::findOrFail($id);
        return view('administrator.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id); // Encontra o professor pelo ID

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:14',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'availability' => 'nullable|array',
            'languages' => 'array',
            'hourly_rate' => 'required|numeric',
            'commission' => 'required|numeric',
            'pix' => 'required|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        $availability = implode(',', $request->input('availability', []));
        $languages = implode(',', $request->input('languages', []));

        $teacher->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'availability' => $availability,
            'languages' => $languages,
            'hourly_rate' => $request->input('hourly_rate'),
            'commission' => $request->input('commission'),
            'pix' => $request->input('pix'),
            'notes' => $request->input('notes'),
        ]);

        return redirect()->route('administrator.teachers.index')->with('success', 'Alterações salvas');
    }

    public function destroy($id) // Encontra o professor pelo ID e o deleta
    { 
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('administrator.teachers.index')->with('success', 'Cadastro excluído');
    }
}

?>