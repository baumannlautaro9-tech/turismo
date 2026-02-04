<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class InspeccionarCsv extends Command
{
    protected $signature = 'turismo:inspeccionar';
    protected $description = 'Inspeccionar estructura del CSV de turismo';

    public function handle(): int
    {
        $this->info('🔍 Inspeccionando CSV de Turismo CyL...');
        $this->newLine();

        $url = 'https://datosabiertos.jcyl.es/web/jcyl/risp/es/turismo/retu/1285002755102.csv';

        try {
            $this->info('📡 Descargando CSV...');
            $response = Http::timeout(120)->get($url);

            if (!$response->successful()) {
                $this->error('Error al descargar el CSV');
                return Command::FAILURE;
            }

            // Guardar temporalmente
            $tmpFile = storage_path('app/turismo_inspeccion.csv');
            file_put_contents($tmpFile, $response->body());

            $this->info(' CSV descargado');
            $this->newLine();

            // Abrir y leer
            $handle = fopen($tmpFile, 'r');

            // Leer encabezados
            $headers = fgetcsv($handle, 0, ',');
            
            $this->info(' ENCABEZADOS DEL CSV:');
            $this->newLine();
            
            foreach ($headers as $index => $header) {
                $this->line(sprintf('  [%2d] %s', $index, $header));
            }

            $this->newLine();
            $this->info(' PRIMERA FILA DE DATOS:');
            $this->newLine();

            // Leer primera fila de datos
            $firstRow = fgetcsv($handle, 0, ',');
            
            if ($firstRow) {
                foreach ($headers as $index => $header) {
                    $valor = $firstRow[$index] ?? 'N/A';
                    // Truncar valores muy largos
                    if (strlen($valor) > 50) {
                        $valor = substr($valor, 0, 47) . '...';
                    }
                    $this->line(sprintf('  %-30s = %s', $header, $valor));
                }
            }

            $this->newLine();
            $this->info('SEGUNDA FILA DE DATOS:');
            $this->newLine();

            // Leer segunda fila
            $secondRow = fgetcsv($handle, 0, ',');
            
            if ($secondRow) {
                foreach ($headers as $index => $header) {
                    $valor = $secondRow[$index] ?? 'N/A';
                    if (strlen($valor) > 50) {
                        $valor = substr($valor, 0, 47) . '...';
                    }
                    $this->line(sprintf('  %-30s = %s', $header, $valor));
                }
            }

            fclose($handle);
            unlink($tmpFile);

            $this->newLine();
            $this->info('Inspección completada');

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}