<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function ofertas()
    {
        return view('ofertas.ofertas');
    }


}
