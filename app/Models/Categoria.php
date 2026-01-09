<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
     protected $table = 'categorias'; 

   // Mostrar los prooductos
    public function products()
    {
        
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}
