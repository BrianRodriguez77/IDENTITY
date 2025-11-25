<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->enum('estado_registro', ['pendiente', 'verificado', 'rechazado'])->default('pendiente');
            $table->string('codigo_verificacion')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('motivo_rechazo')->nullable();
            $table->foreignId('verificado_por')->nullable()->constrained('usuarios');
            $table->timestamp('fecha_verificacion')->nullable();
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn([
                'estado_registro',
                'codigo_verificacion',
                'email_verified_at',
                'motivo_rechazo',
                'verificado_por',
                'fecha_verificacion'
            ]);
        });
    }
};