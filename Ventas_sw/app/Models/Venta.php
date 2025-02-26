<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model {
    use HasFactory;

    protected $fillable = ['cliente', 'total'];

    public function productos() {
        return $this->belongsToMany(Producto::class, 'producto_venta')->withPivot('cantidad', 'subtotal');
    }
}
