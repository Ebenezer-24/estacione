@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>{{ $comercio->razon_social }}</h1>
        </div>
        <div class="card-body">
            <p><strong>CUIT:</strong> {{ $comercio->cuit }}</p>
            <p><strong>Dirección:</strong> {{ $comercio->direccion }}</p>
            <p><strong>Estado:</strong> {{ $comercio->estado }}</p>

            <a href="{{ route('comercios.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection
