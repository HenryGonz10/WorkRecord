<?php

namespace App\Utils;

use App\Models\Parte;
use Illuminate\Support\Facades\DB;

class Partes
{
    public static function getRecords($perPage = 10, $limit = 0)
    {
        // Crear la consulta base con la configuración original
        $query = Parte::select(
            'partes.id as Id',
            'partes.codigo as Codigo',
            'users.name as Cliente',
            'empresas.nombre as Empresa',
            DB::raw('COALESCE(SUM(parte_detalles.monto), 0) as Total')
        )
            ->leftJoin('users', 'partes.cliente_id', '=', 'users.id')
            ->leftJoin('empresas', 'users.empresa_id', '=', 'empresas.id')
            ->leftJoin('parte_detalles', 'partes.id', '=', 'parte_detalles.parte_id')
            ->where('partes.estado', 1)
            ->groupBy('partes.id', 'users.name', 'empresas.nombre')
            ->orderBy('partes.created_at', 'desc');

        // Si el valor del límite es mayor a 0, aplicar el método 'take'
        if ($limit > 0) {
            $query->take($limit);
        }

        // Devolver la consulta paginada
        return $query->paginate($perPage);
    }
}
