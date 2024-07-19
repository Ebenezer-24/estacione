<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Estacionamiento;
use App\Models\Usuario;
use App\Notifications\EstacionamientoAlerta;
use App\Notifications\EstacionamientoExpirado;
use Carbon\Carbon;

class EnviarAlertasEstacionamiento extends Command
{
    protected $signature = 'alertas:estacionamiento';
    protected $description = 'Enviar alertas de estacionamiento faltando 15 minutos y al expirar el tiempo';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $estacionamientos = Estacionamiento::where('estado', 'Estacionado')->get();

        foreach ($estacionamientos as $estacionamiento) {
            $finEstacionamiento = Carbon::parse($estacionamiento->updated_at)->addMinutes($estacionamiento->tiempo);
            $faltanQuinceMinutos = $finEstacionamiento->subMinutes(15);

            if (Carbon::now()->between($faltanQuinceMinutos, $finEstacionamiento)) {
                $usuario = Usuario::where('patente', $estacionamiento->patente)->first();
                if ($usuario) {
                    $usuario->notify(new EstacionamientoAlerta($usuario, $estacionamiento));
                }
            }

            if (Carbon::now()->greaterThanOrEqualTo($finEstacionamiento)) {
                $usuario = Usuario::where('patente', $estacionamiento->patente)->first();
                if ($usuario) {
                    $usuario->notify(new EstacionamientoExpirado($usuario, $estacionamiento));
                    $estacionamiento->update(['estado' => 'Libre', 'patente' => null, 'tiempo' => 0]);
                }
            }
        }

        return 0;
    }
}
