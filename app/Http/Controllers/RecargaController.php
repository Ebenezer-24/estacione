<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recarga;
use App\Models\Comercio;
use App\Models\PagoComercio;
use App\Models\Usuario;
use Carbon\Carbon;

class RecargaController extends Controller
{
    public function index()
    {
        $recargas = Recarga::with('comercio')->get();
        return view('recargas.index', compact('recargas'));
    }

    public function create()
    {
        $comercios = Comercio::all();
        return view('recargas.create', compact('comercios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comercio_id' => 'required|exists:comercios,id',
            'dni' => 'required|integer|exists:usuarios,dni',
            'patente' => 'required|string',
            'importe' => 'required|numeric|min:0.01',
        ]);

        $comercio = Comercio::find($request->comercio_id);
        if ($comercio->estado !== 'autorizado') {
            return back()->withErrors(['comercio_id' => 'El comercio no está autorizado para realizar recargas.']);
        }

        $creditoDisponible = PagoComercio::where('comercio_id', $request->comercio_id)
            ->where('fecha_desde', '<=', Carbon::today())
            ->where('fecha_hasta', '>=', Carbon::today())
            ->sum('importe');

        $recargasRealizadas = Recarga::where('comercio_id', $request->comercio_id)
            ->whereDate('created_at', '>=', Carbon::today()->startOfDay())
            ->whereDate('created_at', '<=', Carbon::today()->endOfDay())
            ->sum('importe');

        if ($recargasRealizadas + $request->importe > $creditoDisponible) {
            return back()->withErrors(['mensaje' => 'Crédito insuficiente para realizar la recarga.']);
        }

        $usuario = Usuario::where('dni', $request->dni)->first();
        if ($usuario) {
            $usuario->saldo += $request->importe;
            $usuario->save();
            // Enviar correo con la factura
            //$usuario->notify(new FacturaRecarga($recarga));
        }

        Recarga::create($request->all());

        return redirect()->route('recargas.index')->with('success', 'Recarga realizada con éxito.');
    }
}
