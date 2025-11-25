<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('centros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150)->unique();
            $table->text('direccion')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->foreignId('regional_id')->constrained()->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('centros');
    }
};