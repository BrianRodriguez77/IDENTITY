<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    
    protected $fillable = [
        'tipo_documento_id',
        'numero_documento',
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'tipo_sangre',
        'fecha_nacimiento',
        'rol_id',
        'regional_id',
        'centro_id',
        'programa_id',
        'grupo_id',
        'huella_digital',
        'foto_url',
        'estado',
        'password',
        'estado_registro',
        'codigo_verificacion',
        'verificado_por',
        'fecha_verificacion'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'huella_digital'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_verificacion' => 'datetime',
    ];

    // Relaciones
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id');
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class, 'centro_id');
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

    public function carnets()
    {
        return $this->hasMany(Carnet::class, 'usuario_id');
    }

    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
}