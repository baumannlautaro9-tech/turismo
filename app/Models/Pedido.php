<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
     protected $table = 'pedidos'; // <--- Nombre exacto en tu BBDD
    
    
    protected $fillable = ['user_id', 'total', 'estado'];
}
