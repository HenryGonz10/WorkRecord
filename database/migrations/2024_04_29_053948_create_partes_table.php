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
        Schema::create('partes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 8)->unique();
            $table->foreignId('cliente_id')->nullable()->constrained('users')->onDelete('no action');
            $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('no action');
            $table->dateTime('fecha_firma')->nullable();
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
        Schema::dropIfExists('partes');
    }
};
