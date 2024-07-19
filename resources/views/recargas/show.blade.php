@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Recarga #{{ $recarga->id }}</h1>
        </div>
        <div class="card-body">
            <p><strong>Comercio:</strong> {{ $recarga->comercio->razon_social }}</p>
            <p><strong>DNI:</strong> {{ $recarga->dni }}</p>
            <p><strong>Patente:</strong> {{ $recarga->patente }}</p>
            <p><strong>Importe:</strong> {{ $recarga->importe }}</p>
            <p><strong>Fecha:</strong> {{ $recarga->created_at }}</p>

            <a href="{{ route('recargas.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection
