<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamentos;

class DepartamentosController extends Controller
{
    public function getAll()
    {
        $departamentos = Departamentos::all();
        return view('departamentos', compact('departamentos'));
    }
}