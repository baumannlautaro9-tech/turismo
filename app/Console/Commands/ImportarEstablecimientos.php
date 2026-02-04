<?php

namespace App\Console\Commands;

use App\Models\Establecimiento;
use App\Services\TurismoApiService;
use Illuminate\Console\Command;

class ImportarEstablecimientos extends Command
{
    protected $signature = 'turismo:importar {--limit=}';
    protected $description = 'Importar establecimientos turísticos';

    public function handle(TurismoApiService $apiService): int
    {
        $this->info('🚀 Importando establecimientos...');

        $limit = $this->option('limit');
        $procesados = $importados = $actualizados = $errores = 0;

        foreach ($apiService->obtenerEstablecimientos() as $data) {
            if ($limit && $procesados >= (int) $limit) break;

            try {
                $datos = $apiService->transformarEstablecimiento($data);

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

        return Command::SUCCESS;
    }
}
