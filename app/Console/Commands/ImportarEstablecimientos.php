<?php

namespace App\Console\Commands;

use App\Models\Establecimiento;
use App\Services\TurismoApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportarEstablecimientos extends Command
{
    protected $signature = 'turismo:importar 
                            {--limit= : Limitar cantidad de registros}';
    
    protected $description = 'Importar establecimientos desde la API de Castilla y León';

    public function handle(TurismoApiService $apiService): int
    {
        $this->info('🚀 Importando establecimientos turísticos...');
        $this->newLine();

        // Aumentar límites
        ini_set('memory_limit', '512M');
        set_time_limit(600); // 10 minutos

        $limit = $this->option('limit');

        $this->info('📡 Descargando y procesando datos desde la API...');
        $this->info('⏳ Esto puede tardar varios minutos...');
        $this->newLine();

        $importados = 0;
        $actualizados = 0;
        $errores = 0;
        $procesados = 0;

        // Obtener el generador
        $establecimientos = $apiService->obtenerEstablecimientos();

        // Procesar por lotes
        $lote = [];
        $tamañoLote = 100;

        foreach ($establecimientos as $establecimientoData) {
            // Si hay límite y ya lo alcanzamos, salir
            if ($limit && $procesados >= (int)$limit) {
                break;
            }

            $lote[] = $establecimientoData;
            $procesados++;

            // Cuando el lote esté lleno, procesarlo
            if (count($lote) >= $tamañoLote) {
                $resultado = $this->procesarLote($lote, $apiService);
                $importados += $resultado['importados'];
                $actualizados += $resultado['actualizados'];
                $errores += $resultado['errores'];
                
                $this->info("✓ Procesados: {$procesados} | Importados: {$importados} | Actualizados: {$actualizados} | Errores: {$errores}");
                
                // Limpiar lote
                $lote = [];
                
                // Liberar memoria
                gc_collect_cycles();
            }
        }

        // Procesar últimos registros si quedan
        if (!empty($lote)) {
            $resultado = $this->procesarLote($lote, $apiService);
            $importados += $resultado['importados'];
            $actualizados += $resultado['actualizados'];
            $errores += $resultado['errores'];
        }

        $this->newLine(2);

        // Resumen
        $this->info('📊 RESUMEN DE LA IMPORTACIÓN:');
        $this->table(
            ['Estado', 'Cantidad'],
            [
                ['✅ Nuevos importados', $importados],
                ['🔄 Actualizados', $actualizados],
                ['❌ Errores', $errores],
                ['📦 Total procesados', $procesados],
            ]
        );

        $this->newLine();
        $this->info('✨ Importación completada exitosamente!');

        return Command::SUCCESS;
    }

    private function procesarLote(array $lote, TurismoApiService $apiService): array
    {
        $importados = 0;
        $actualizados = 0;
        $errores = 0;

        DB::beginTransaction();

        try {
            foreach ($lote as $establecimientoData) {
                try {
                    $datosTransformados = $apiService->transformarEstablecimiento($establecimientoData);

                    if (empty($datosTransformados['n_registro'])) {
                        $errores++;
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
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Error en lote: " . $e->getMessage());
        }

        return [
            'importados' => $importados,
            'actualizados' => $actualizados,
            'errores' => $errores
        ];
    }
}