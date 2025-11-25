<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Agregar el campo 'password' si no existe
            if (!Schema::hasColumn('usuarios', 'password')) {
                $table->string('password')->after('email');
            }

            // Agregar el campo 'estado_registro' si no existe
            if (!Schema::hasColumn('usuarios', 'estado_registro')) {
                $table->enum('estado_registro', ['pendiente', 'verificado', 'rechazado'])->default('pendiente')->after('estado');
            }

            // Agregar el campo 'codigo_verificacion' si no existe
            if (!Schema::hasColumn('usuarios', 'codigo_verificacion')) {
                $table->string('codigo_verificacion', 40)->nullable()->after('estado_registro');
            }

            // Agregar el campo 'verificado_por' si no existe
            if (!Schema::hasColumn('usuarios', 'verificado_por')) {
                $table->unsignedBigInteger('verificado_por')->nullable()->after('codigo_verificacion');
                // Asegúrate de que la tabla 'users' exista, si no, puedes usar 'usuarios' pero ten en cuenta que es la misma tabla de usuarios?
                // En tu caso, 'verificado_por' hace referencia a un usuario que verifica, pero ¿es un usuario de la tabla 'users' o 'usuarios'?
                // Si es de la tabla 'users', entonces:
                $table->foreign('verificado_por')->references('id')->on('users');
                // Si es de la tabla 'usuarios', entonces:
                // $table->foreign('verificado_por')->references('id')->on('usuarios');
            }

            // Agregar el campo 'fecha_verificacion' si no existe
            if (!Schema::hasColumn('usuarios', 'fecha_verificacion')) {
                $table->timestamp('fecha_verificacion')->nullable()->after('verificado_por');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Eliminar las claves foráneas primero
            if (Schema::hasColumn('usuarios', 'verificado_por')) {
                $table->dropForeign(['verificado_por']);
            }

            // Eliminar las columnas
            $table->dropColumn(['password', 'estado_registro', 'codigo_verificacion', 'verificado_por', 'fecha_verificacion']);
        });
    }
};
