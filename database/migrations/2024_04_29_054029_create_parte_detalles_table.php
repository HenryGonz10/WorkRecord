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
        Schema::create('parte_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parte_id')->nullable()->constrained('partes')->onDelete('no action');
            $table->string('titulo');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_final');
            $table->decimal('duracion', 10, 2)->nullable();
            $table->decimal('monto', 12, 2)->nullable();
            $table->string('observacion')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parte_detalles');
    }
};
