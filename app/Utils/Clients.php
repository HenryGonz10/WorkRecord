<?php

namespace App\Utils;

use App\Models\User;

class Clients
{
    public static function getCountClients()
    {
        return User::where('estado', 1)->whereNotNull('empresa_id')->count();
    }

    public static function getPaginatedClients($perPage = 10, $limit = 0)
    {
        // Crear la consulta base para obtener usuarios con paginación
        $query = User::select(
            'users.id as Id',
            'users.codigo as Codigo',
            'empresas.nombre as Empresa',
            'users.name as Cliente',
            'users.email as Email'
        )
            ->leftJoin('empresas', 'users.empresa_id', '=', 'empresas.id') // Unir con empresas
            ->where('users.estado', 1) // Filtrar por estado
            //->where('users.password', null) // Filtrar por condición de password
            ->orderBy('users.id', 'asc'); // Ordenar por ID

        // Aplicar 'take' solo si el parámetro 'limit' es mayor a cero
        if ($limit > 0) {
            $query->take($limit);
        }

        // Aplicar paginación y devolver resultados
        return $query->paginate($perPage);
    }

    public static function findClientByEmail($email)
    {
        // Buscar un usuario por correo electrónico
        return User::where('estado', 1)->whereNotNull('empresa_id')->where('email', $email)->first(); // Devuelve el primer usuario que coincide
    }
}
