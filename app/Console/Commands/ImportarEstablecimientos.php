<?php

namespace App\Console\Commands;

use App\Models\Establecimiento;
use App\Services\TurismoApiService;
use Illuminate\Console\Command;

class ImportarEstablecimientos extends Command
{
    protected $signature = 'turismo:importar {--force : Forzar actualización}';
    protected $description = 'Importar establecimientos desde la API de Castilla y León';

    public function handle(TurismoApiService $apiService): int
    {
        $this->info('🚀 Importando establecimientos turísticos...');
        $this->newLine();

        // Obtener datos de la API
        $forceRefresh = $this->option('force');
        
        if ($forceRefresh) {
            $this->warn('Forzando actualización (ignorando caché)...');
        }

        $this->info('📡 Descargando datos desde la API...');
        $establecimientos = $apiService->obtenerEstablecimientos($forceRefresh);

        if (empty($establecimientos)) {
            $this->error('❌ No se pudieron obtener datos de la API');
            return Command::FAILURE;
        }

        $this->info("✅ Obtenidos " . count($establecimientos) . " registros");
        $this->newLine();

        // Importar con barra de progreso
        $bar = $this->output->createProgressBar(count($establecimientos));
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%%');
        $bar->start();

        $importados = 0;
        $actualizados = 0;
        $errores = 0;

        foreach ($establecimientos as $establecimientoData) {
            try {
                $datosTransformados = $apiService->transformarEstablecimiento($establecimientoData);

                if (empty($datosTransformados['n_registro'])) {
                    $errores++;
                    $bar->advance();
                    continue;
                }

                $establecimiento = Establecimiento::updateOrCreate(
                    ['n_registro' => $datosTransformados['n_registro']],
                    $datosTransformados
                );

                if ($establecimiento->wasRecentlyCreated) {
                    $importados++;
                } else {
                    $actualizados++;
                }

            } catch (\Exception $e) {
                $errores++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Resumen
        $this->info('📊 RESUMEN:');
        $this->table(
            ['Estado', 'Cantidad'],
            [
                ['✅ Nuevos', $importados],
                ['🔄 Actualizados', $actualizados],
                ['❌ Errores', $errores],
                ['📦 Total', count($establecimientos)],
            ]
        );

        $this->newLine();
        $this->info('✨ Importación completada!');

        return Command::SUCCESS;
    }
}