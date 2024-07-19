<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'comercio_id',
        'dni',
        'patente',
        'importe',
    ];

    public function comercio()
    {
        return $this->belongsTo(Comercio::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'dni', 'dni');
    }
}
