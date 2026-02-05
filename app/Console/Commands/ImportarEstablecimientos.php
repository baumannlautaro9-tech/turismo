<?php

namespace App\Console\Commands;

use App\Models\Establecimiento;
use App\Services\TurismoApiService;
use Illuminate\Console\Command;

class ImportarEstablecimientos extends Command
{
    protected $signature = 'turismo:importar {--limit=}';
    protected $description = 'Importar establecimientos turísticos y actualizar cache';

    public function handle(TurismoApiService $apiService): int
    {
        $this->info('Importando establecimientos...');

        // ✅ Usamos el método cacheado del servicio
        $establecimientos = $apiService->obtenerEstablecimientosCacheados();

        $limit = $this->option('limit');
        $procesados = $importados = $actualizados = $errores = 0;

        foreach ($establecimientos as $datos) {
            if ($limit && $procesados >= (int) $limit) break;

            try {
                if (!$datos['n_registro']) {
                    $errores++;
                    continue;
                }

                $model = Establecimiento::updateOrCreate(
                    ['n_registro' => $datos['n_registro']],
                    $datos
                );

                $model->wasRecentlyCreated ? $importados++ : $actualizados++;
                $procesados++;

            } catch (\Throwable $e) {
                $errores++;
                $this->error($e->getMessage());
            }
        }

        $this->table(
            ['Estado', 'Cantidad'],
            [
                ['Importados', $importados],
                ['Actualizados', $actualizados],
                ['Errores', $errores],
                ['Procesados', $procesados],
            ]
        );

        $this->info('Caché de turismo actualizada y datos importados.');
        return Command::SUCCESS;
    }
}
