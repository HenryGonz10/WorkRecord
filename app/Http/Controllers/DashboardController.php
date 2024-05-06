<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\Clients;
use App\Utils\Partes;

class DashboardController extends Controller
{
    public function index()
    {
        // Acceder a las variables declaradas
        return view('dashboard.index', [
            'totalClients' => Clients::getCountClients(),
            'ultimosRegistros' => Partes::getRecords(10,10),
            'ultimosClientes' => Clients::getPaginatedClients(10,10),
        ]);
    }
}
