<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioRolEspecial extends Model
{
    use HasFactory;

    protected $table = 'usuario_roles_especiales';

    protected $fillable = [
        'usuario_id',
        'rol_especial_id',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function rolEspecial()
    {
        return $this->belongsTo(RolesEspeciales::class, 'rol_especial_id');
    }
}