<?php

namespace App\Http\Controllers;
use App\Models\TipoDocumento;

use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    public function getAll()
    {
        $tipoDocumento = TipoDocumento::all();
        return view('tipo_documento', compact('tipoDocumento'));
    }

    public function create()
    {
        return view('tipo_documento.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'idTipoDocumento' => 'required|unique:tipo_documento|max:3',
            'tipoDocumento' => 'required|max:15',
            'descripcion' => 'max:250',
        ]);

        TipoDocumento::create($request->all());

        return redirect()->route('tipo_documento')
                        ->with('success', 'Tipo de documento creado exitosamente.');
    }

    public function edit($id)
    {
        $tipoDocumento = TipoDocumento::findOrFail($id);
        return view('tipo_documento.edit', compact('tipoDocumento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipoDocumento' => 'required|max:15',
            'descripcion' => 'max:250',
        ]);

        $tipoDocumento = TipoDocumento::findOrFail($id);
        $tipoDocumento->update($request->all());

        return redirect()->route('tipo_documento')
                        ->with('success', 'Tipo de documento actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $tipoDocumento = TipoDocumento::findOrFail($id);
        $tipoDocumento->delete();

        return redirect()->route('tipo_documento.delete')
                        ->with('success', 'Tipo de documento eliminado exitosamente.');
    }

}
