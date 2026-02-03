<?php

namespace App\Services;

use Generator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TurismoApiService
{
    // URL del CSV
    private const API_URL = 'https://datosabiertos.jcyl.es/web/jcyl/risp/es/turismo/retu/1285002755102.csv';
    
    // Provincias válidas de Castilla y León
    private const PROVINCIAS_CYL = [
        'Ávila',
        'Burgos',
        'León',
        'Palencia',
        'Salamanca',
        'Segovia',
        'Soria',
        'Valladolid',
        'Zamora'
    ];

    /**
     * Obtener establecimientos procesando línea por línea
     */
    public function obtenerEstablecimientos(): Generator
    {
        $tmpFile = storage_path('app/turismo_temp.csv');

        try {
            Log::info('Descargando CSV desde la API...');

            $response = Http::timeout(120)->get(self::API_URL);

            if (!$response->successful()) {
                Log::error('Error al descargar CSV', ['status' => $response->status()]);
                return;
            }

            file_put_contents($tmpFile, $response->body());
            
            Log::info('CSV descargado. Procesando...');

            $handle = fopen($tmpFile, 'r');
            
            if ($handle === false) {
                Log::error('No se pudo abrir el archivo CSV');
                return;
            }

            // CRÍTICO: Usar punto y coma (;) como delimitador
            $headers = fgetcsv($handle, 0, ';');
            
            if ($headers === false) {
                Log::error('No se pudieron leer los encabezados');
                fclose($handle);
                return;
            }

            // Limpiar encabezados (quitar espacios y BOM)
            $headers = array_map(function($h) {
                return trim(str_replace("\xEF\xBB\xBF", '', $h));
            }, $headers);

            Log::info('Encabezados encontrados:', $headers);

            $lineNumber = 1;
            $procesados = 0;
            $filtrados = 0;
            
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                $lineNumber++;
                
                // Saltar líneas vacías
                if (empty(array_filter($row))) {
                    continue;
                }

                // Combinar encabezados con valores
                if (count($headers) === count($row)) {
                    $data = array_combine($headers, $row);
                    
                    // FILTRAR: Solo provincias de Castilla y León
                    $provincia = trim($data['provincia'] ?? '');
                    if (!in_array($provincia, self::PROVINCIAS_CYL)) {
                        $filtrados++;
                        Log::debug("Línea {$lineNumber}: Provincia '{$provincia}' no es de CyL. Omitido.");
                        continue;
                    }
                    
                    $procesados++;
                    yield $data;
                } else {
                    Log::warning("Línea {$lineNumber}: Columnas no coinciden. Esperadas: " . count($headers) . ", Recibidas: " . count($row));
                }
            }

            fclose($handle);

            if (file_exists($tmpFile)) {
                unlink($tmpFile);
            }

            Log::info('Procesamiento completado', [
                'procesados' => $procesados,
                'filtrados_fuera_cyl' => $filtrados,
                'total_lineas' => $lineNumber
            ]);

        } catch (\Exception $e) {
            Log::error('Error procesando CSV', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            if (file_exists($tmpFile)) {
                unlink($tmpFile);
            }
        }
    }

    /**
     * Transformar datos del CSV a formato BD
     */
    public function transformarEstablecimiento(array $data): array
    {
        // Validar que tenga nombre y registro
        $nombre = !empty($data['nombre']) ? trim($data['nombre']) : null;
        $n_registro = !empty($data['n_registro']) ? trim($data['n_registro']) : 
                     (!empty($data['codigo']) ? trim($data['codigo']) : null);
        
        if (!$nombre || !$n_registro) {
            Log::warning('Establecimiento sin nombre o registro', $data);
        }
        
        return [
            // n_registro: usar el campo 'n_registro' o 'codigo'
            'n_registro' => $n_registro,
            
            // nombre
            'nombre' => $nombre,
            
            // tipo (priorizar 'tipo', luego 'establecimiento')
            'tipo' => !empty($data['tipo']) ? trim($data['tipo']) : 
                     (!empty($data['establecimiento']) ? trim($data['establecimiento']) : null),
            
            // categoria
            'categoria' => !empty($data['categoria']) ? trim($data['categoria']) : null,
            
            // clase (puede ser útil guardarlo también)
            'clase' => !empty($data['clase']) ? trim($data['clase']) : null,
            
            // ubicacion
            'direccion' => !empty($data['direccion']) ? trim($data['direccion']) : null,
            'c_postal' => !empty($data['c_postal']) ? trim($data['c_postal']) : null,
            'provincia' => !empty($data['provincia']) ? trim($data['provincia']) : null,
            'municipio' => !empty($data['municipio']) ? trim($data['municipio']) : null,
            'localidad' => !empty($data['localidad']) ? trim($data['localidad']) : 
                          (!empty($data['nucleo']) ? trim($data['nucleo']) : null),
            
            // capacidad
            'plazas' => $this->convertirNumero($data['plazas'] ?? null),
            
            // accesibilidad
            'accesible' => $this->convertirBooleano($data['accesible_a_personas_con_discapacidad'] ?? null),
            
            // contacto
            'telefono_1' => !empty($data['telefono_1']) ? trim($data['telefono_1']) : null,
            'telefono_2' => !empty($data['telefono_2']) ? trim($data['telefono_2']) : null,
            'email' => !empty($data['email']) ? filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL) ?: null : null,
            'web' => !empty($data['web']) ? $this->limpiarUrl(trim($data['web'])) : null,
            
            // GPS (priorizar 'gps_latitud' y 'gps_longitud')
            'gps_latitud' => $this->convertirCoordenada($data['gps_latitud'] ?? null),
            'gps_longitud' => $this->convertirCoordenada($data['gps_longitud'] ?? null),
            
            // Calidad (si existe)
            'q_calidad' => !empty($data['q_calidad']) ? trim($data['q_calidad']) : null,
        ];
    }

    /**
     * Convertir a número
     */
    private function convertirNumero(?string $valor): ?int
    {
        if ($valor === null || trim($valor) === '') {
            return null;
        }
        
        // Limpiar y convertir
        $valor = preg_replace('/[^0-9]/', '', $valor);
        return $valor !== '' ? (int)$valor : null;
    }

    /**
     * Convertir a booleano
     */
    private function convertirBooleano(?string $valor): bool
    {
        if ($valor === null || trim($valor) === '') {
            return false;
        }
        
        $valor = strtolower(trim($valor));
        
        // Valores que representan "true"
        $valoresTrue = ['si', 'sí', 's', 'yes', 'y', '1', 'true', 'adaptado', 'accesible'];
        
        return in_array($valor, $valoresTrue);
    }

    /**
     * Convertir coordenada GPS
     */
    private function convertirCoordenada(?string $valor): ?float
    {
        if ($valor === null || trim($valor) === '' || $valor === '0' || $valor === '0.0') {
            return null;
        }
        
        // Reemplazar coma por punto
        $valor = str_replace(',', '.', trim($valor));
        
        $float = (float)$valor;
        
        // Validar que no sea cero y que sea una coordenada válida para España
        // Latitud España: 36-44
        // Longitud España: -10 a 5
        if ($float === 0.0) {
            return null;
        }
        
        return $float;
    }
    
    /**
     * Limpiar URL (quitar espacios, validar formato básico)
     */
    private function limpiarUrl(?string $url): ?string
    {
        if ($url === null || trim($url) === '') {
            return null;
        }
        
        $url = trim($url);
        
        // Si no tiene protocolo, añadir http://
        if (!preg_match('/^https?:\/\//i', $url)) {
            $url = 'http://' . $url;
        }
        
        // Validar que sea una URL válida
        return filter_var($url, FILTER_VALIDATE_URL) ?: null;
    }
}