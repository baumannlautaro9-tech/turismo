<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
        protected $table = 'linea_pedidos'; 

   
    protected $fillable = ['pedido_id', 'producto_id', 'cantidad', 'precio'];
}
