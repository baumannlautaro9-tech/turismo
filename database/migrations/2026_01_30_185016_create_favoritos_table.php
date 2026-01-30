<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favoritos', function (Blueprint $table) {
            // Claves foráneas
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
                  
            $table->foreignId('establecimiento_id')
                  ->constrained('establecimientos')
                  ->onDelete('cascade');
            
            // Clave primaria compuesta
            $table->primary(['user_id', 'establecimiento_id']);
            
            // Timestamp para saber cuándo se añadió a favoritos
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};