<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Estacionamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:usuarios,dni',
            'nombre' => 'required',
            'apellido' => 'required',
            'domicilio' => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'fecha_nacimiento' => 'required|date',
            'patente' => 'required|unique:usuarios,patente',
            'password' => 'required',
        ]);

        $usuario = new Usuario($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return redirect()->route('usuarios.index');
    }

    public function show(Usuario $usuario)
    {
        $estacionamiento = Estacionamiento::where('patente', $usuario->patente)->where('estado', 'Estacionado')->first();
        return view('usuarios.show', compact('usuario', 'estacionamiento'));
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'domicilio' => 'required',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'fecha_nacimiento' => 'required|date',
            'patente' => 'required|unique:usuarios,patente,' . $usuario->id,
        ]);

        $usuario->update($request->except('password'));

        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
            $usuario->save();
        }

        return redirect()->route('usuarios.index');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}
