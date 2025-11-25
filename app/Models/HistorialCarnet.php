<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCarnet extends Model
{
    use HasFactory;

    protected $table = 'historial_carnets';

    protected $fillable = [
        'carnet_id',
        'usuario_id',
        'accion',
        'descripcion',
        'usuario_accion_id'
    ];

    public $timestamps = false;

    public function carnet()
    {
        return $this->belongsTo(Carnet::class, 'carnet_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function usuarioAccion()
    {
        return $this->belongsTo(Usuario::class, 'usuario_accion_id');
    }
}