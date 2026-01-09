<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Importante para insertar datos

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // Insertamos datos manualmente
        DB::table('categorias')->insert([
            ['nombre' => 'Fútbol', 'descripcion' => 'Todo para el deporte rey', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Baloncesto', 'descripcion' => 'Canastas, balones y ropa NBA', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Running', 'descripcion' => 'Zapatillas y equipamiento para correr', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tenis', 'descripcion' => 'Raquetas y accesorios', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Otros', 'descripcion' => 'Accesorios variados y nutrición', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}