<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\Clients;

class ClientesController extends Controller
{
    public function index()
    {
        // Acceder a las variables declaradas
        return view('clientes.index', [
            'headers' => ['Id', 'Codigo', 'Empresa', 'Cliente', 'Email', 'Opciones'],
            'clients' => Clients::getPaginatedClients(10,10),
        ]);
    }

    public function create(){
        return view('clientes.create', [
            
        ]);
    }
}
