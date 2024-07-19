<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\Http\Request;

class ComercioController extends Controller
{
    public function index()
    {
        $comercios = Comercio::all();
        return view('comercios.index', compact('comercios'));
    }

    public function create()
    {
        return view('comercios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cuit' => 'required|digits:11|unique:comercios,cuit',
            'razon_social' => 'required',
            'direccion' => 'required',
        ]);

        Comercio::create([
            'cuit' => $request->cuit,
            'razon_social' => $request->razon_social,
            'direccion' => $request->direccion,
            'estado' => 'autorizado',
        ]);

        return redirect()->route('comercios.index');
    }

    public function show(Comercio $comercio)
    {
        return view('comercios.show', compact('comercio'));
    }

    public function edit(Comercio $comercio)
    {
        return view('comercios.edit', compact('comercio'));
    }

    public function update(Request $request, Comercio $comercio)
    {
        $request->validate([
            'cuit' => 'required|digits:11|unique:comercios,cuit,' . $comercio->id,
            'razon_social' => 'required',
            'direccion' => 'required',
        ]);

        $comercio->update($request->all());

        return redirect()->route('comercios.index');
    }

    public function destroy(Comercio $comercio)
    {
        $comercio->update(['estado' => 'suspendido']);

        return redirect()->route('comercios.index');
    }
}
