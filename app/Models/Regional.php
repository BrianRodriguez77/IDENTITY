<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    use HasFactory;

    protected $table = 'regionales';

    protected $fillable = [
        'nombre',
        'codigo'
    ];

    public function centros()
    {
        return $this->hasMany(Centro::class, 'regional_id');
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'regional_id');
    }
}