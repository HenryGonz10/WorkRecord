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

    public function getCompany(Request $request) {
        $term = $request->input('term');
        return Clients::searchCompany($term); // Buscamos por coincidencia
    }

    public function create(Request $request) {
        $companyId = $request->query('company');
        $company = null;

        if ($companyId) {
            $company = Clients::getCompany($companyId);
        }

        // Comprobar si la empresa no se encontró correctamente
        if ($company instanceof \Illuminate\Http\JsonResponse && property_exists($company->getData(), 'error')) {
            // Devolver un error más detallado o redirigir a una página de error
            return abort(404, $company->getData()->error);
        }

        return view('clientes.create', [
            'company' => $company,
        ]);
    }

    public function store(Request $request) {
        return back()->withInput()->with('error', 'Ocurrió un error al guardar el cliente. Por favor, inténtalo de nuevo.');
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $request->id, // Se excluye el correo actual al validar la unicidad
            // Agrega aquí las validaciones para otros campos
        ]);

        // Si existe el campo 'id' en la solicitud, significa que estamos actualizando un cliente existente
        if ($request->has('id')) {

        } else {

        }

        // Redirigir a una ruta de éxito o mostrar un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente guardado exitosamente.');
    }
}
