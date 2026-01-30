<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->id();
            
            // Identificación
            $table->string('n_registro')->unique();
            $table->string('nombre');
            
            // Clasificación
            $table->string('tipo')->nullable();
            $table->string('categoria')->nullable();
            
            // Ubicación
            $table->string('direccion')->nullable();
            $table->string('c_postal', 10)->nullable();
            $table->string('provincia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('localidad')->nullable();
            
            // Capacidad y accesibilidad
            $table->integer('plazas')->nullable();
            $table->boolean('accesible')->default(false);
            
            // Contacto
            $table->string('telefono_1')->nullable();
            $table->string('telefono_2')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            
            // GPS
            $table->decimal('gps_latitud', 10, 8)->nullable();
            $table->decimal('gps_longitud', 11, 8)->nullable();
            
            $table->timestamps();
            
            // Índices para búsquedas rápidas
            $table->index('provincia');
            $table->index('municipio');
            $table->index('tipo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('establecimientos');
    }
};