<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagoComercio;
use App\Models\Comercio;
use Carbon\Carbon;
class PagoComercioController extends Controller
{
    public function index()
    {
        $pagoComercios = PagoComercio::with('comercio')->get();
        return view('pagos_comercios.index', compact('pagoComercios'));
    }

    public function create()
    {
        $comercios = Comercio::all();
        return view('pagos_comercios.create', compact('comercios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comercio_id' => 'required|exists:comercios,id',
            'fecha_desde' => 'required|date',
            'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
            'importe' => 'required|numeric|min:0.01',
        ]);

        PagoComercio::create($request->all());

        return redirect()->route('pagos_comercios.index')->with('success', 'Pago Comercio creado con éxito.');
    }

    public function show($id)
    {
        $pagoComercio = PagoComercio::findOrFail($id);
        $comercio = $pagoComercio->comercio;

        $creditoDisponible = PagoComercio::where('comercio_id', $comercio->id)
            ->where('fecha_desde', '<=', Carbon::today())
            ->where('fecha_hasta', '>=', Carbon::today())
            ->sum('importe');

        return view('pagos_comercios.show', compact('pagoComercio', 'comercio', 'creditoDisponible'));
    }

    public function edit(PagoComercio $pagoComercio)
    {
        $comercios = Comercio::all();
        return view('pagos_comercios.edit', compact('pagoComercio', 'comercios'));
    }

    public function update(Request $request, PagoComercio $pagoComercio)
    {
        $request->validate([
            'comercio_id' => 'required|exists:comercios,id',
            'fecha_desde' => 'required|date',
            'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
            'importe' => 'required|numeric|min:0.01',
        ]);

        $pagoComercio->update($request->all());

        return redirect()->route('pagos_comercios.index')->with('success', 'Pago Comercio actualizado con éxito.');
    }

    public function destroy(PagoComercio $pagoComercio)
    {
        $pagoComercio->delete();
        return redirect()->route('pagos_comercios.index')->with('success', 'Pago Comercio eliminado con éxito.');
    }
}
