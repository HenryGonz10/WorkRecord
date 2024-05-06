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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('cif')->unique(); // Código CIF, único para cada empresa
            $table->string('nombre'); // Nombre de la empresa
            $table->string('domicilio'); // Domicilio
            $table->string('telefono'); // Teléfono
            $table->string('email')->unique(); // Correo electrónico
            $table->string('web')->nullable(); // Sitio web (opcional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
