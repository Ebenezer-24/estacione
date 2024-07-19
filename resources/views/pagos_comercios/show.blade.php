@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Detalles del Pago Comercio
        </div>
        <div class="card-body">
            @if ($pagoComercio->comercio)
                <p><strong>Comercio:</strong> {{ $pagoComercio->comercio->razon_social }}</p>
                <p><strong>Crédito Disponible:</strong> {{ $creditoDisponible }}</p>
            @else
                <p><strong>Comercio:</strong> Comercio no encontrado</p>
            @endif
            <p><strong>Fecha Desde:</strong> {{ $pagoComercio->fecha_desde }}</p>
            <p><strong>Fecha Hasta:</strong> {{ $pagoComercio->fecha_hasta }}</p>
            <p><strong>Importe:</strong> {{ $pagoComercio->importe }}</p>
            <p><strong>Fecha de Creación:</strong> {{ $pagoComercio->created_at }}</p>
            <p><strong>Última Actualización:</strong> {{ $pagoComercio->updated_at }}</p>

            <a href="{{ route('pagos_comercios.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
