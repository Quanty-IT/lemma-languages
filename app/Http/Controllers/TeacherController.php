<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Exibir lista de professores
    public function index()
    {
        $teachers = Teacher::all();
        return view('administrator.teachers.index', compact('teachers'));
    }

    // Exibir o formulário para criação de um novo professor
    public function create()
    {
        return view('administrator.teachers.create');
    }

    // Armazenar o novo professor no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:14',
            'email' => 'email|unique:teachers,email',
            'language' => 'required|string',
            'availabily' => 'string',
            'hourly_rate' => 'required|number',
            'commission' => 'required|number',
            'pix' => 'string',
            'notes' => 'nullable|string|max:1000',
        ]);

        Teacher::create($request->all());

        return redirect()->route('administrator.teachers.index')->with('success', 'Professor cadastrado com sucesso!');
    }

    // Mostrar detalhes do professor
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('administrator.teachers.show', compact('teacher'));
    }

    // Exibir o formulário para editar os dados do professor
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('administrator.teachers.edit', compact('teacher'));
    }

    // Atualizar os dados do professor
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'specialty' => 'nullable|string|max:255',
        ]);

        $teacher->update($request->all());

        return redirect()->route('administrator.teachers.index')->with('success', 'Professor atualizado com sucesso!');
    }

    // Deletar professor
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('administrator.teachers.index')->with('success', 'Professor deletado com sucesso!');
    }
}

?>