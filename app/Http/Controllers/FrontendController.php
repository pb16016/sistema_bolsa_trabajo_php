<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
        return view('auth.login');

    }

    public function registrar()
    {
        return view('persona.persona-register');
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function main(Request $request)
    {
        // Recibe el parámetro email de la URL
        $email = $request->query('email');
        
        // Puedes hacer algo con el correo electrónico si es necesario
        return view('main', compact('email'));
    }

    public function cvs(Request $request)
    {
        // Recibe el parámetro email de la URL
        $email = $request->query('email');
        
        // Puedes hacer algo con el correo electrónico si es necesario
        return view('cvs', compact('email'));
    }

    public function personaView(Request $request)
    {
        try {
            // Recibe el parámetro email de la URL
            $email = $request->query('email');
            
            // Puedes hacer algo con el correo electrónico si es necesario
            return view('persona.persona-view', compact('email'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al cargar la vista: ' . $e->getMessage()], 500);
        }
    }



    public function showAllCvs()
    {
        $cvs = CVs::all();
        return view('ofertas.cvs', compact('cvs'));
    }
}
