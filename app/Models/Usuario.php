<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'dni';
    public $incrementing = false;
    
    
    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'domicilio',
        'email',
        'fecha_nacimiento',
        'patente',
        'password',
        'saldo',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function estacionamientos()
    {
        return $this->hasMany(Estacionamiento::class, 'patente', 'patente');
    }
}

