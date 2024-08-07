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

    public function update(Request $request,Usuario $usuario, $dni)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'domicilio' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $dni . ',dni',
            'fecha_nacimiento' => 'required|date',
            'patente' => 'required|unique:usuarios,patente,' . $usuario->id,
            'password' => 'sometimes|string|min:8',
            
        ]);
        $usuario->update($request->except('password'));
        $usuario = Usuario::findOrFail($dni);
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->domicilio = $request->domicilio;
        $usuario->email = $request->email;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->patente_vehiculo = $request->patente_vehiculo;

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
