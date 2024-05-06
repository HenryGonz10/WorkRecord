<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Parte extends Model
{
    use HasFactory;

    // Permitir asignación masiva para estos campos
    protected $fillable = [
        'codigo',
        'cliente_id',
        'usuario_id',
        'fecha_firma',
        'observacion',
        'estado',     // Estado del usuario (activo/inactivo)
    ];

    /**
     * Relación con el usuario que es cliente
     */
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id'); // Relación con el usuario que es cliente
    }

    /**
     * Relación con el usuario que emite el parte de trabajo
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id'); // Relación con el usuario responsable
    }

    // Relación con la tabla ParteDetalle
    public function parteDetalles()
    {
        return $this->hasMany(Parte_detalle::class, 'parte_id'); // Un Parte puede tener muchos ParteDetalles
    }

    protected static function generateUniqueCode()
    {
        $code = Str::upper(Str::random(8));

        while (self::where('codigo', $code)->exists()) {
            $code = Str::upper(Str::random(8));
        }

        return $code;
    }

    // Antes de crear un nuevo usuario, asigna un código único
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->codigo)) {
                $user->codigo = self::generateUniqueCode();
            }
        });
    }
}
