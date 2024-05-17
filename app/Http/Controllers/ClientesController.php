<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\Clients;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Validation\Rule;

class ClientesController extends Controller
{
    public function index()
    {
        // Acceder a las variables declaradas
        return view('clientes.index', [
            'headers' => ['Id', 'Codigo', 'Empresa', 'Cliente', 'Email', 'Opciones'],
            'clients' => Clients::getPaginatedClients(10, 10),
        ]);
    }

    public function getCompany(Request $request)
    {
        $term = $request->input('term');
        return Clients::searchCompany($term); // Buscamos por coincidencia
    }

    public function create($encoded = null)
    {
        $company = null;
        $companyId = null;
        $client = null;
        $clientId = null;

        // Decodificar el parámetro opcional si está presente
        if ($encoded) {
            $decoded = base64_decode($encoded);
            parse_str($decoded, $params);
            $companyId = isset($params['company']) ? $params['company'] : null;
            $clientId = isset($params['client']) ? $params['client'] : null;
        }

        if ($clientId) {
            $client = Clients::getClient($clientId);
            if ($client) {
                $companyId = $client->empresa_id;
            }
        }

        if ($companyId) {
            $company = Clients::getCompany($companyId);
        }

        // Comprobar si la empresa no se encontró correctamente
        if ($company instanceof \Illuminate\Http\JsonResponse && property_exists($company->getData(), 'error')) {
            // Devolver un error más detallado o redirigir a una página de error
            return abort(404, $company->getData()->error);
        }

        return view('clientes.create', [
            'client' => $client,
            'company' => $company,
        ]);
    }

    public function store(Request $request)
    {
        Log::info('Entrando al método store');
        DB::beginTransaction();

        try {
            // Validar los datos del formulario
            $validated = $request->validate([
                'empresa_id' => 'nullable|exists:empresas,id',
                'cif' => 'required|string|max:255|unique:empresas,cif,' . $request->empresa_id,
                'nombre' => 'required|string|max:255',
                'domicilio' => 'required|string|max:255',
                'telefono' => 'required|string|max:255',
                'email' => 'required|email|unique:empresas,email,' . $request->empresa_id,
                'web' => 'nullable|string|max:255',
                'client_id' => 'nullable|exists:users,id',
                'client_name' => 'required|string|max:255',
                'client_email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($request->client_id)
                ],
            ]);

            Log::info('Datos validados:', $validated);

            // Si existe empresa_id, actualizar la empresa, sino crear una nueva
            if ($request->has('empresa_id') && $request->empresa_id) {
                Log::info('Actualizando empresa con ID: ' . $request->empresa_id);
                $empresa = Empresa::find($request->empresa_id);
                $empresa->update([
                    'cif' => $validated['cif'],
                    'nombre' => $validated['nombre'],
                    'domicilio' => $validated['domicilio'],
                    'telefono' => $validated['telefono'],
                    'email' => $validated['email'],
                    'web' => $validated['web'],
                ]);
            } else {
                Log::info('Creando nueva empresa');
                $empresa = Empresa::create([
                    'cif' => $validated['cif'],
                    'nombre' => $validated['nombre'],
                    'domicilio' => $validated['domicilio'],
                    'telefono' => $validated['telefono'],
                    'email' => $validated['email'],
                    'web' => $validated['web'],
                ]);
            }

            // Si existe client_id, actualizar el usuario, sino crear uno nuevo
            if ($request->has('client_id') && $request->client_id) {
                Log::info('Actualizando usuario con ID: ' . $request->client_id);
                $user = User::find($request->client_id);
                $user->update([
                    'empresa_id' => $empresa->id,
                    'name' => $validated['client_name'],
                    'email' => $validated['client_email'],
                ]);
            } else {
                Log::info('Creando nuevo usuario');
                $user = User::create([
                    'empresa_id' => $empresa->id,
                    'name' => $validated['client_name'],
                    'email' => $validated['client_email']
                ]);
            }

            DB::commit();

            Log::info('Transacción completada exitosamente');
            return redirect()->route('clientes.index')->with('success', 'Cliente guardado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar el cliente: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al guardar el cliente: ' . $e->getMessage());
        }
    }

    public function delete($clientId)
    {
        Log::info('Inicio de eliminación');

        // Buscar el usuario por el ID
        $user = User::find($clientId);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado.'], 404);
        }

        // Cambiar el estado a false
        $user->estado = false;

        // Guardar los cambios
        $user->save();

        // Retornar una respuesta JSON indicando éxito
        return response()->json(['success' => true, 'message' => 'Usuario eliminado exitosamente.']);
    }
}
