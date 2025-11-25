<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tipo_documento';

    protected $fillable = [
        'nombre',
        'abreviatura'
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'tipo_documento_id');
    }
}