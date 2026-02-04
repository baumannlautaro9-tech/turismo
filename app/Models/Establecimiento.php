<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    protected $table = 'establecimientos';

    protected $fillable = [
        'n_registro',
        'nombre',
        'tipo',
        'categoria',
        'direccion',
        'c_postal',
        'provincia',
        'municipio',
        'localidad',
        'plazas',
        'accesible',
        'telefono_1',
        'telefono_2',
        'email',
        'web',
        'gps_latitud',
        'gps_longitud',
    ];
}
