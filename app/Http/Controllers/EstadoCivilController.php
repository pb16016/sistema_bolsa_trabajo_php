<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoCivil;

class EstadoCivilController extends Controller
{
    public function getAll()
    {
        $estadoCivil = EstadoCivil::all();
        return view('estadocivil', compact('estadoCivil'));
    }

    public function create()
    {
        return view('estadocivil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codEstadoCivil' => 'required|unique:estadocivil|max:3',
            'EstadoCivil' => 'required|max:15',
        ]);

        EstadosCivil::create($request->all());

        return redirect()->route('estadocivil')
                        ->with('success', 'Estado civil creado exitosamente.');
    }

    public function edit($id)
    {
        $estadoCivil = EstadosCivil::findOrFail($id);
        return view('estadocivil.edit', compact('estadoCivil'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'EstadoCivil' => 'required|max:15',
        ]);

        $estadoCivil = EstadosCivil::findOrFail($id);
        $estadoCivil->update($request->all());

        return redirect()->route('estadocivil')
                        ->with('success', 'Estado civil actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $estadoCivil = EstadosCivil::findOrFail($id);
        $estadoCivil->delete();

        return redirect()->route('estadocivil')
                        ->with('success', 'Estado civil eliminado exitosamente.');
    }

}
