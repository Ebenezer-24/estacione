@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>{{ $usuario->nombre }} {{ $usuario->apellido }}</h1>
        </div>
        <div class="card-body">
            <p><strong>DNI:</strong> {{ $usuario->dni }}</p>
            <p><strong>Domicilio:</strong> {{ $usuario->domicilio }}</p>
            <p><strong>Email:</strong> {{ $usuario->email }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $usuario->fecha_nacimiento }}</p>
            <p><strong>Patente:</strong> {{ $usuario->patente }}</p>
            <p><strong>Saldo Disponible:</strong> {{ $usuario->saldo }}</p>

            @if($estacionamiento)
                <p><strong>Estado de Estacionamiento:</strong> Estacionado en el espacio {{ $estacionamiento->id }}</p>
            @else
                <p><strong>Estado de Estacionamiento:</strong> Libre</p>
            @endif

            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection
