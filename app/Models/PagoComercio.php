<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoComercio extends Model
{
    use HasFactory;

    protected $fillable = [
        'comercio_id', 'fecha_desde', 'fecha_hasta', 'importe'
    ];

    public function comercio()
    {
        return $this->belongsTo(Comercio::class);
    }
}
