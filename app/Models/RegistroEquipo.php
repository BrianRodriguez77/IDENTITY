<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEquipo extends Model
{
    use HasFactory;

    protected $table = 'registro_equipos';

    protected $fillable = [
        'usuario_id',
        'tipo_equipo',
        'marca',
        'modelo',
        'serial',
        'descripcion',
        'fecha_registro',
        'fecha_retiro',
        'estado',
        'observaciones'
    ];

    protected $casts = [
        'fecha_registro' => 'date',
        'fecha_retiro' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}