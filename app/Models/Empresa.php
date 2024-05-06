<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    // Campos asignables en masa
    protected $fillable = [
        'cif',        // Código CIF
        'nombre',     // Nombre de la empresa
        'domicilio',  // Domicilio
        'telefono',   // Teléfono
        'email',      // Correo electrónico
        'web',        // Sitio web
    ];

    // Campos que deben ser únicos
    protected $unique = [
        'cif',   // Código CIF debe ser único
        'email', // Correo electrónico debe ser único
    ];

    // Relación entre Empresa y Usuarios
    public function users()
    {
        return $this->hasMany(User::class); // Una empresa tiene muchos usuarios
    }

    // Ejemplo de método personalizado (opcional)
    public function nombreCompleto()
    {
        return $this->cif . ' - ' . $this->nombre; // Método para obtener información combinada
    }
}
