<?php

namespace App\Console\Commands;

use App\Services\TurismoApiService;
use Illuminate\Console\Command;

class DebugImportacion extends Command
{
    protected $signature = 'turismo:debug';
    protected $description = 'Debug detallado de la importación';

    public function handle(TurismoApiService $apiService): int
    {
        $this->info('🔍 DEBUG DE IMPORTACIÓN');
        $this->newLine();

        $contador = 0;
        
        foreach ($apiService->obtenerEstablecimientos() as $data) {
            $contador++;
            
            $this->info("════════════════════════════════════════");
            $this->info("REGISTRO #{$contador}");
            $this->info("════════════════════════════════════════");
            $this->newLine();
            
            // Mostrar datos crudos del CSV
            $this->warn('DATOS CRUDOS DEL CSV:');
            foreach ($data as $key => $value) {
                $displayValue = strlen($value) > 60 ? substr($value, 0, 57) . '...' : $value;
                $this->line(sprintf('  %-35s = %s', $key, $displayValue));
            }
            
            $this->newLine();
            
            // Intentar transformar
            try {
                $transformado = $apiService->transformarEstablecimiento($data);
                
                $this->info('DATOS TRANSFORMADOS:');
                foreach ($transformado as $key => $value) {
                    if ($value === null) {
                        $displayValue = 'NULL';
                    } elseif (is_bool($value)) {
                        $displayValue = $value ? 'true' : 'false';
                    } else {
                        $displayValue = strlen($value) > 60 ? substr($value, 0, 57) . '...' : $value;
                    }
                    $this->line(sprintf('  %-20s = %s', $key, $displayValue));
                }
                
                $this->newLine();
                
                // Verificar n_registro
                if (empty($transformado['n_registro'])) {
                    $this->error('❌ ERROR: n_registro está vacío!');
                } else {
                    $this->info('✅ n_registro OK: ' . $transformado['n_registro']);
                }
                
            } catch (\Exception $e) {
                $this->error('ERROR AL TRANSFORMAR:');
                $this->error($e->getMessage());
                $this->error($e->getTraceAsString());
            }
            
            $this->newLine();
            
            // Solo procesar 3 registros para debug
            if ($contador >= 3) {
                break;
            }
        }
        
        $this->info("Procesados {$contador} registros para debug");
        
        return Command::SUCCESS;
    }
}