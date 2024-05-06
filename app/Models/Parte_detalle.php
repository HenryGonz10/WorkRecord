<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parte_detalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'parte_id',
        'titulo',
        'fecha_inicio',
        'fecha_final',
        'duracion',
        'monto',
        'observacion',
        'estado',
    ];

    // Relación con la tabla Parte
    public function parte()
    {
        return $this->belongsTo(Parte::class, 'parte_id'); // El ParteDetalle pertenece a un Parte
    }
}
