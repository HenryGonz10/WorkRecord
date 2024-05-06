<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\Clients;

class PartesController extends Controller
{
    public function index()
    {
        // Acceder a las variables declaradas
        return view('partes.index', [
            'headers' => ['Id', 'Codigo', 'Empresa', 'Cliente', 'Email', 'Opciones'],
            'clients' => Clients::getPaginatedClients(10,10),
        ]);
    }

    public function create(){
        return view('partes.create', [

        ]);
    }
}
