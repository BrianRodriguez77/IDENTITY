<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesEspeciales extends Model
{
    use HasFactory;

    protected $table = 'roles_especiales';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function usuarioRolesEspeciales()
    {
        return $this->hasMany(UsuarioRolEspecial::class, 'rol_especial_id');
    }
}