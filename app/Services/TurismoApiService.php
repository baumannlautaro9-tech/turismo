<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TurismoApiService
{
    // URL de la API de Castilla y León
    private const API_URL = 'https://datosabiertos.jcyl.es/web/jcyl/risp/es/turismo/retu/1285002755102.json';
    
    // Caché de 24 horas (la API se actualiza diariamente)
    private const CACHE_DURATION = 1440; // minutos

    /**
     * Obtener todos los establecimientos desde la API
     */
    public function obtenerEstablecimientos(bool $forceRefresh = false): array
    {
        $cacheKey = 'turismo_establecimientos_data';

        if ($forceRefresh) {
            Cache::forget($cacheKey);
        }

        return Cache::remember($cacheKey, self::CACHE_DURATION * 60, function () {
            try {
                Log::info('Descargando datos desde la API de Turismo CyL');
                
                $response = Http::timeout(60)->get(self::API_URL);

                if (!$response->successful()) {
                    Log::error('Error al obtener datos de la API', [
                        'status' => $response->status()
                    ]);
                    return [];
                }

                $data = $response->json();
                
                Log::info('Datos obtenidos correctamente', [
                    'total_registros' => count($data)
                ]);

                return $data;

            } catch (\Exception $e) {
                Log::error('Excepción al conectar con la API', [
                    'message' => $e->getMessage()
                ]);
                return [];
            }
        });
    }

    /**
     * Transformar datos de la API al formato de la BD
     */
    public function transformarEstablecimiento(array $data): array
    {
        return [
            'n_registro' => $data['codigo'] ?? $data['n_registro'] ?? null,
            'nombre' => $data['nombre'] ?? $data['denominacion'] ?? null,
            'tipo' => $data['tipo'] ?? $data['tipo_establecimiento'] ?? null,
            'categoria' => $data['categoria'] ?? $data['clasificacion'] ?? null,
            'direccion' => $data['direccion'] ?? $data['domicilio'] ?? null,
            'c_postal' => $data['c_postal'] ?? $data['codigo_postal'] ?? $data['cp'] ?? null,
            'provincia' => $data['provincia'] ?? null,
            'municipio' => $data['municipio'] ?? $data['localidad'] ?? null,
            'localidad' => $data['localidad'] ?? $data['poblacion'] ?? null,
            'plazas' => isset($data['plazas']) ? (int)$data['plazas'] : null,
            'accesible' => isset($data['accesible']) ? (bool)$data['accesible'] : false,
            'telefono_1' => $data['telefono_1'] ?? $data['telefono'] ?? null,
            'telefono_2' => $data['telefono_2'] ?? null,
            'email' => $data['email'] ?? $data['correo'] ?? null,
            'web' => $data['web'] ?? $data['url'] ?? null,
            'gps_latitud' => isset($data['latitud']) ? (float)$data['latitud'] : null,
            'gps_longitud' => isset($data['longitud']) ? (float)$data['longitud'] : null,
        ];
    }
}