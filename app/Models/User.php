<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'empresa_id', // Clave foránea para la relación con Empresa
        'codigo',     // Código único de 8 caracteres
        'name',       // Nombre del usuario
        'email',      // Correo electrónico
        'password',   // Contraseña
        'estado',     // Estado del usuario (activo/inactivo)
        'current_team_id', // Equipo actual (si es aplicable)
        'profile_photo_path', // Ruta de la foto de perfil (si es aplicable)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Relación entre Usuario y Empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class); // Usuario pertenece a una Empresa
    }

    // Relación para partes donde el usuario es cliente
    public function partesCliente()
    {
        return $this->hasMany(Parte::class, 'cliente_id'); // Un usuario puede ser cliente de varias partes
    }

    // Relación para partes donde el usuario es responsable
    public function partesUsuario()
    {
        return $this->hasMany(Parte::class, 'usuario_id'); // Un usuario puede ser responsable de varias partes
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
