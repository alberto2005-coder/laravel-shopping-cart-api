<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock'];

    public function carritos()
    {
        return $this->belongsToMany(Carrito::class, 'articulo_carrito')->withPivot('cantidad');
    }

    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'articulo_venta')->withPivot('cantidad', 'precio');
    }
}
