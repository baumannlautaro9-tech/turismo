<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
   public function run(): void
{
    DB::table('productos')->insert([
        // FÚTBOL (ID 1)
        ['nombre' => 'Balón Champions League', 'descripcion' => 'Balón oficial final 2024.', 'precio' => 29.99, 'stock' => 50, 'categoria_id' => 1, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Botas Nike Mercurial', 'descripcion' => 'Botas de velocidad césped artificial.', 'precio' => 89.50, 'stock' => 20, 'categoria_id' => 1, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Espinilleras Carbono', 'descripcion' => 'Protección ligera y resistente.', 'precio' => 15.00, 'stock' => 30, 'categoria_id' => 1, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Guantes Portero Adidas', 'descripcion' => 'Agarre profesional.', 'precio' => 35.00, 'stock' => 10, 'categoria_id' => 1, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Camiseta Selección Española', 'descripcion' => 'Primera equipación oficial.', 'precio' => 79.99, 'stock' => 50, 'categoria_id' => 1, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],

        // BALONCESTO (ID 2)
        ['nombre' => 'Camiseta Lakers Lebron', 'descripcion' => 'Camiseta oficial amarilla.', 'precio' => 75.00, 'stock' => 15, 'categoria_id' => 2, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Balón Spalding NBA', 'descripcion' => 'Tacto de cuero premium.', 'precio' => 45.00, 'stock' => 25, 'categoria_id' => 2, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Canasta Mini', 'descripcion' => 'Para habitación o oficina.', 'precio' => 20.00, 'stock' => 10, 'categoria_id' => 2, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Zapatillas Jordan Air', 'descripcion' => 'Clásicas para la cancha.', 'precio' => 120.00, 'stock' => 5, 'categoria_id' => 2, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Muñequera NBA', 'descripcion' => 'Absorbe el sudor.', 'precio' => 8.00, 'stock' => 100, 'categoria_id' => 2, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],

        // RUNNING (ID 3)
        ['nombre' => 'Adidas Ultraboost', 'descripcion' => 'Amortiguación máxima.', 'precio' => 120.00, 'stock' => 10, 'categoria_id' => 3, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Reloj Garmin', 'descripcion' => 'GPS y pulsómetro.', 'precio' => 199.99, 'stock' => 5, 'categoria_id' => 3, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Calcetines Compresión', 'descripcion' => 'Mejora la circulación.', 'precio' => 12.50, 'stock' => 40, 'categoria_id' => 3, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Cinturón Hidratación', 'descripcion' => 'Lleva agua y llaves.', 'precio' => 18.00, 'stock' => 15, 'categoria_id' => 3, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Cortavientos Ligero', 'descripcion' => 'Para correr con viento.', 'precio' => 30.00, 'stock' => 12, 'categoria_id' => 3, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],

        // TENIS (ID 4)
        ['nombre' => 'Raqueta Wilson Pro', 'descripcion' => 'Equilibrio y potencia.', 'precio' => 150.00, 'stock' => 8, 'categoria_id' => 4, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Pack 3 Pelotas Dunlop', 'descripcion' => 'Para todas las superficies.', 'precio' => 5.99, 'stock' => 100, 'categoria_id' => 4, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Grip Raqueta', 'descripcion' => 'Pack de 3 grips blancos.', 'precio' => 4.50, 'stock' => 50, 'categoria_id' => 4, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],

        // OTROS (ID 5)
        ['nombre' => 'Botella de Agua Metal', 'descripcion' => 'Mantiene el frío 24h.', 'precio' => 12.00, 'stock' => 30, 'categoria_id' => 5, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Toalla Microfibra', 'descripcion' => 'Secado rápido para gym.', 'precio' => 9.00, 'stock' => 25, 'categoria_id' => 5, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Bolsa de Deporte', 'descripcion' => 'Con compartimento zapatos.', 'precio' => 25.00, 'stock' => 15, 'categoria_id' => 5, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
        ['nombre' => 'Proteína Whey 1kg', 'descripcion' => 'Sabor Chocolate.', 'precio' => 35.00, 'stock' => 20, 'categoria_id' => 5, 'imagen' => '', 'created_at' => now(), 'updated_at' => now()],
    ]);
}
}