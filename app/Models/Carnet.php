<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carnet extends Model
{
    use HasFactory;

    protected $table = 'carnets';

    protected $fillable = [
        'usuario_id',
        'codigo_barras',
        'codigo_qr',
        'fecha_emision',
        'fecha_vencimiento',
        'estado_carnet_id',
        'version',
        'motivo_emision',
        'observaciones'
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'fecha_vencimiento' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function estadoCarnet()
    {
        return $this->belongsTo(EstadoCarnet::class, 'estado_carnet_id');
    }

    public function historialCarnets()
    {
        return $this->hasMany(HistorialCarnet::class, 'carnet_id');
    }

    public function registrosAcceso()
    {
        return $this->hasMany(RegistroAcceso::class, 'carnet_id');
    }
}