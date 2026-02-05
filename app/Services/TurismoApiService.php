<?php

namespace App\Services;

use Generator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class TurismoApiService
{
    private const API_URL =
        'https://datosabiertos.jcyl.es/web/jcyl/risp/es/turismo/retu/1285002755102.csv';

    private const PROVINCIAS_CYL = [
        'Ávila',
        'Burgos',
        'León',
        'Palencia',
        'Salamanca',
        'Segovia',
        'Soria',
        'Valladolid',
        'Zamora',
    ];

   /* Lectura con cache */
    public function obtenerEstablecimientosCacheados(bool $force = false): array
{
    if ($force) {
        Cache::forget('turismo_establecimientos');
    }

    return Cache::remember('turismo_establecimientos', now()->addDay(), function () {
        $resultados = [];
        foreach ($this->obtenerEstablecimientos() as $data) {
            $resultados[] = $this->transformarEstablecimiento($data);
        }
        return $resultados;
    });
}

     
    /* LECTURA CSV*/
    public function obtenerEstablecimientos(): Generator
    {
        $tmpFile = storage_path('app/turismo_temp.csv');

        $response = Http::timeout(120)->get(self::API_URL);
        if (!$response->successful()) {
            Log::error('Error descargando CSV');
            return;
        }

        file_put_contents($tmpFile, $response->body());

        $handle = fopen($tmpFile, 'r');
        $headers = fgetcsv($handle, 0, ';');

        $headers = array_map(
            fn ($h) => trim(str_replace("\xEF\xBB\xBF", '', $h)),
            $headers
        );

        $provinciasValidas = array_map(
            fn ($p) => $this->normalizarTexto($p),
            self::PROVINCIAS_CYL
        );

        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            if (count($row) !== count($headers)) {
                continue;
            }

            $data = array_combine($headers, $row);

            $provincia = $this->normalizarTexto($data['provincia'] ?? '');
            if (!in_array($provincia, $provinciasValidas)) {
                continue;
            }

            yield $data;
        }

        fclose($handle);
        unlink($tmpFile);
    }

    /* Funcion para transformar los datos */
    public function transformarEstablecimiento(array $data): array
    {
        return [
            'n_registro' => $data['n_registro'] ?? $data['codigo'] ?? null,
            'nombre'     => $data['nombre'] ?? null,

            'tipo'       => $data['tipo'] ?? $data['establecimiento'] ?? null,
            'categoria'  => $data['categoria'] ?? null,

            'direccion'  => $data['direccion'] ?? null,
            'c_postal'   => $data['c_postal'] ?? null,
            'provincia'  => $data['provincia'] ?? null,
            'municipio'  => $data['municipio'] ?? null,
            'localidad'  => $data['localidad'] ?? $data['nucleo'] ?? null,

            'plazas'     => $this->convertirNumero($data['plazas'] ?? null),
            'accesible'  => $this->convertirBooleano(
                $data['accesible_a_personas_con_discapacidad'] ?? null
            ),

            'telefono_1' => $data['telefono_1'] ?? null,
            'telefono_2' => $data['telefono_2'] ?? null,

            'email'      => !empty($data['email'])
                ? filter_var($data['email'], FILTER_VALIDATE_EMAIL)
                : null,

            'web'        => $this->limpiarUrl($data['web'] ?? null),

            'gps_latitud'  => $this->convertirCoordenada($data['gps_latitud'] ?? null),
            'gps_longitud' => $this->convertirCoordenada($data['gps_longitud'] ?? null),
        ];
    }

    /* Funciones */
    private function normalizarTexto(?string $texto): string
    {
        if (!$texto) return '';
        $texto = iconv('UTF-8', 'ASCII//TRANSLIT', trim($texto));
        return strtoupper($texto);
    }

    private function convertirNumero(?string $valor): ?int
    {
        if (!$valor) return null;
        $valor = preg_replace('/[^0-9]/', '', $valor);
        return $valor !== '' ? (int) $valor : null;
    }

    private function convertirBooleano(?string $valor): bool
    {
        if (!$valor) return false;

        return in_array(
            strtolower(trim($valor)),
            ['si','sí','s','yes','1','true','adaptado','accesible']
        );
    }

    private function convertirCoordenada(?string $valor): ?float
    {
        if (!$valor) return null;
        $valor = str_replace(',', '.', trim($valor));
        $float = (float) $valor;
        return $float !== 0.0 ? $float : null;
    }

    private function limpiarUrl(?string $url): ?string
    {
        if (!$url) return null;

        if (!preg_match('/^https?:\/\//i', $url)) {
            $url = 'http://' . $url;
        }

        return filter_var($url, FILTER_VALIDATE_URL) ?: null;
    }
}
