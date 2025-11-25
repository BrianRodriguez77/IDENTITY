<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $table = 'programas';

    protected $fillable = [
        'nombre',
        'codigo',
        'duracion_meses',
        'nivel_formacion',
        'estado'
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'programa_id');
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'programa_id');
    }
}