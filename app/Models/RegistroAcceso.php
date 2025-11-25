<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroAcceso extends Model
{
    use HasFactory;

    protected $table = 'registros_acceso';

    protected $fillable = [
        'usuario_id',
        'carnet_id',
        'tipo_escaneo',
        'ubicacion',
        'proposito',
        'fecha_hora_escaneo',
        'observaciones'
    ];

    protected $casts = [
        'fecha_hora_escaneo' => 'datetime',
    ];

    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function carnet()
    {
        return $this->belongsTo(Carnet::class, 'carnet_id');
    }
}