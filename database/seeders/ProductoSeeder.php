<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([
            // PRODUCTOS DE FÚTBOL (category_id = 1)
            [
                'nombre' => 'Balón Champions League',
                'descripcion' => 'Balón oficial de la final 2024. Alta resistencia.',
                'precio' => 29.99,
                'stock' => 50,
                'categoria_id' => 1,
                'imagen' => 'balon_champions.jpg', // Pondremos una imagen de prueba luego
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'nombre' => 'Botas Nike Mercurial',
                'descripcion' => 'Botas de velocidad para césped artificial.',
                'precio' => 89.50,
                'stock' => 20,
                'categoria_id' => 1,
                'imagen' => 'botas_nike.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            
            // PRODUCTOS DE BALONCESTO (category_id = 2)
            [
                'nombre' => 'Camiseta Lakers Lebron',
                'descripcion' => 'Camiseta oficial amarilla de Los Angeles Lakers.',
                'precio' => 75.00,
                'stock' => 15,
                'categoria_id' => 2,
                'imagen' => 'camiseta_lakers.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],

            // PRODUCTOS DE RUNNING (category_id = 3)
            [
                'nombre' => 'Zapatillas Adidas Ultraboost',
                'descripcion' => 'Amortiguación máxima para maratones.',
                'precio' => 120.00,
                'stock' => 10,
                'categoria_id' => 3,
                'imagen' => 'adidas_running.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
             [
                'nombre' => 'Reloj Garmin Forerunner',
                'descripcion' => 'GPS integrado y monitor de frecuencia cardíaca.',
                'precio' => 199.99,
                'stock' => 5,
                'categoria_id' => 3,
                'imagen' => 'garmin.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}