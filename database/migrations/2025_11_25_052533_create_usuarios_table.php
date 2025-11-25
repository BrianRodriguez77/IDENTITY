<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_documento_id')->constrained('tipo_documento');
            $table->string('numero_documento', 50)->unique();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('email', 150)->unique()->nullable();
            $table->string('telefono', 20)->nullable();
            $table->enum('tipo_sangre', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->date('fecha_nacimiento')->nullable();
            $table->foreignId('rol_id')->constrained('roles');
            $table->foreignId('regional_id')->constrained('regionales');
            $table->foreignId('centro_id')->constrained('centros');
            $table->foreignId('programa_id')->nullable()->constrained('programas');
            $table->foreignId('grupo_id')->nullable()->constrained('grupos');
            $table->string('foto_url')->nullable();
            $table->enum('estado', ['activo', 'inactivo', 'suspendido'])->default('activo');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->index(['numero_documento']);
            $table->index(['estado']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};