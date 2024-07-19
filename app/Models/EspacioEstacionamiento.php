<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspacioEstacionamiento extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'estado'];
}