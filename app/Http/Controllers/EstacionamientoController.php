<?php

namespace App\Http\Controllers;

use App\Models\Estacionamiento;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EstacionamientoController extends Controller
{
    public function index()
    {
        $estacionamientos = Estacionamiento::all();
        return view('estacionamientos.index', compact('estacionamientos'));
    }

    public function create()
    {
        $estacionamientos = Estacionamiento::all();
        return view('estacionamientos.create', compact('estacionamientos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patente' => 'required|exists:usuarios,patente',
            'espacio' => 'required|exists:estacionamientos,id',
            'estado' => 'required|in:Estacionado,Libre',
            'tiempo' => 'required|integer|min:15',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('patente', $request->patente)->firstOrFail();

        if (!Hash::check($request->password, $usuario->password)) {
            return redirect()->back()->withErrors(['password' => 'Contraseña incorrecta.']);
        }

        $estacionamiento = Estacionamiento::findOrFail($request->espacio);
        if ($estacionamiento->estado == $request->estado) {
            return redirect()->back()->withErrors([
                'estado' => 'No se puede cambiar el estado a ' . $request->estado . ' dos veces seguidas.'
            ]);
        }

        $costoPorFraccion = 1; // Asumiendo un costo de 1 unidad monetaria por cada 15 minutos
        $saldoNecesario = ($request->tiempo / 15) * $costoPorFraccion;

        if ($request->estado == 'Estacionado' && $usuario->saldo < $saldoNecesario) {
            $tiempoPermitido = floor(($usuario->saldo / $costoPorFraccion) * 15);
            return redirect()->back()->withErrors([
                'saldo' => 'No tiene saldo suficiente. Solo le alcanza para ' . $tiempoPermitido . ' minutos.'
            ]);
        }

        $estacionamiento->update([
            'patente' => $request->patente,
            'estado' => $request->estado,
            'tiempo' => $request->tiempo,
        ]);

        if ($request->estado == 'Estacionado') {
            $usuario->saldo -= $saldoNecesario;
            $usuario->save();
        }

        return redirect()->route('estacionamientos.index');
    }

    public function show(Estacionamiento $estacionamiento)
    {
        return view('estacionamientos.show', compact('estacionamiento'));
    }

    public function edit(Estacionamiento $estacionamiento)
    {
        return view('estacionamientos.edit', compact('estacionamiento'));
    }

    public function update(Request $request, Estacionamiento $estacionamiento)
    {
        $request->validate([
            'estado' => 'required|in:Estacionado,Libre',
            'tiempo' => 'required|integer|min:15',
        ]);

        $estacionamiento->update($request->all());

        return redirect()->route('estacionamientos.index');
    }

    public function liberar(Request $request, Estacionamiento $estacionamiento)
    {
        $request->validate([
            'patente' => 'required|exists:usuarios,patente',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('patente', $request->patente)->firstOrFail();

        if (!Hash::check($request->password, $usuario->password)) {
            return redirect()->back()->withErrors(['password' => 'Contraseña incorrecta.']);
        }

        if ($estacionamiento->estado == 'Libre') {
            return redirect()->back()->withErrors([
                'estado' => 'El espacio ya está libre.'
            ]);
        }

        $estacionamiento->update([
            'patente' => null,
            'estado' => 'Libre',
            'tiempo' => 0,
        ]);

        return redirect()->route('estacionamientos.index');
    }
}
?>
