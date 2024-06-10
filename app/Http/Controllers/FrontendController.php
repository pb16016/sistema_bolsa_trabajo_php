<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FrontendController extends Controller
{
    public function ofertas()
    {
        return view('ofertas.ofertas');
    }

    public function empresas()
    {
        return view('empresa.empresas');
    }

    public function login()
    {
        return view('login');
    }
    public function persona()
    {
        return view('persona');
    }


    public function showAllCvs()
    {
        $cvs = CVs::all();
        return view('ofertas.cvs', compact('cvs'));
    }
}
