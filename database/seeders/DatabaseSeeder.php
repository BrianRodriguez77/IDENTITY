<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tipos de documento
        DB::table('tipo_documento')->insert([
            ['nombre' => 'Cédula de Ciudadanía', 'abreviatura' => 'CC'],
            ['nombre' => 'Tarjeta de Identidad', 'abreviatura' => 'TI'],
            ['nombre' => 'Cédula de Extranjería', 'abreviatura' => 'CE'],
            ['nombre' => 'Pasaporte', 'abreviatura' => 'PAS'],
        ]);

        // Regionales
        DB::table('regionales')->insert([
            ['nombre' => 'Regional Boyacá', 'codigo' => 'RBOY'],
        ]);

        // Centros
        DB::table('centros')->insert([
            [
                'nombre' => 'Centro de la Innovación Agroindustrial y de Servicios',
                'direccion' => 'Municipio de Puerto Boyacá',
                'telefono' => '(8) 123-4567',
                'regional_id' => 1
            ],
        ]);

        // Roles
        DB::table('roles')->insert([
            ['nombre' => 'Aprendiz', 'descripcion' => 'Estudiante en formación del SENA'],
            ['nombre' => 'Instructor', 'descripcion' => 'Personal encargado de la formación'],
            ['nombre' => 'Administrativo', 'descripcion' => 'Personal de apoyo administrativo'],
            ['nombre' => 'Funcionario', 'descripcion' => 'Personal directivo y de gestión'],
            ['nombre' => 'Apoyo', 'descripcion' => 'Personal de apoyo y servicios generales'],
        ]);

        // Usuario de prueba
        DB::table('usuarios')->insert([
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '123456789',
                'nombres' => 'Admin',
                'apellidos' => 'SENA',
                'email' => 'admin@sena.edu.co',
                'tipo_sangre' => 'O+',
                'rol_id' => 4, // Funcionario
                'regional_id' => 1,
                'centro_id' => 1,
                'password' => Hash::make('password123'),
                'estado' => 'activo'
            ]
        ]);
    }
}
