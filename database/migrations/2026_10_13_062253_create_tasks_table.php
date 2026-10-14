<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar las migraciones.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title', 150);
            $table->text('description')->nullable();

            $table->enum('priority', [
                'baja',
                'media',
                'alta'
            ])->default('media');

            $table->enum('status', [
                'pendiente',
                'en_progreso',
                'completada'
            ])->default('pendiente');

            $table->date('due_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};