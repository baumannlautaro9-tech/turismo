<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Establecimiento;
use Illuminate\Console\Command;

class TestFavoritos extends Command
{
    protected $signature = 'test:favoritos';
    protected $description = 'Probar sistema de favoritos';

    public function handle(): int
    {
        $this->info('🧪 Probando sistema de favoritos...');
        $this->newLine();

        // Obtener primer usuario
        $user = User::first();
        
        if (!$user) {
            $this->error('No hay usuarios. Crea uno primero.');
            return Command::FAILURE;
        }

        $this->info("Usuario: {$user->name} (ID: {$user->id})");
        $this->newLine();

        // Obtener primer establecimiento
        $establecimiento = Establecimiento::first();
        
        if (!$establecimiento) {
            $this->error('No hay establecimientos. Importa datos primero.');
            return Command::FAILURE;
        }

        $this->info("Establecimiento: {$establecimiento->nombre} (ID: {$establecimiento->id})");
        $this->newLine();

        // Probar hasFavorito ANTES
        $this->info('1️⃣ Verificando si está en favoritos ANTES...');
        $esFavoritoAntes = $user->hasFavorito($establecimiento->id);
        $this->line("   Resultado: " . ($esFavoritoAntes ? 'SÍ' : 'NO'));
        $this->newLine();

        // Añadir a favoritos
        $this->info('2️⃣ Añadiendo a favoritos...');
        try {
            $user->addFavorito($establecimiento->id);
            $this->line('   ✅ Añadido correctamente');
        } catch (\Exception $e) {
            $this->error('   ❌ Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
        $this->newLine();

        // Verificar DESPUÉS
        $this->info('3️⃣ Verificando si está en favoritos DESPUÉS...');
        $esFavoritoDespues = $user->hasFavorito($establecimiento->id);
        $this->line("   Resultado: " . ($esFavoritoDespues ? 'SÍ' : 'NO'));
        $this->newLine();

        // Contar favoritos
        $totalFavoritos = $user->favoritos()->count();
        $this->info("📊 Total de favoritos del usuario: {$totalFavoritos}");
        $this->newLine();

        // Verificar en base de datos directamente
        $this->info('4️⃣ Verificando en base de datos directamente...');
        $existe = \DB::table('favoritos')
            ->where('user_id', $user->id)
            ->where('establecimiento_id', $establecimiento->id)
            ->exists();
        $this->line("   Existe en BD: " . ($existe ? 'SÍ' : 'NO'));
        $this->newLine();

        if ($esFavoritoDespues && $existe) {
            $this->info('✅ ¡Sistema de favoritos funciona correctamente!');
        } else {
            $this->error('❌ Hay un problema con el sistema de favoritos');
        }

        return Command::SUCCESS;
    }
}