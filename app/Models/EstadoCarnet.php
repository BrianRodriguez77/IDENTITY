<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCarnet extends Model
{
    use HasFactory;

    protected $table = 'estado_carnet';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function carnets()
    {
        return $this->hasMany(Carnet::class, 'estado_carnet_id');
    }
}