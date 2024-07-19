@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Recargas</h1>
        <a href="{{ route('recargas.create') }}" class="btn btn-primary">Agregar Recarga</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Comercio</th>
                <th>DNI</th>
                <th>Patente</th>
                <th>Importe</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recargas as $recarga)
                <tr>
                    <td>{{ $recarga->id }}</td>
                    <td>{{ $recarga->comercio->razon_social }}</td>
                    <td>{{ $recarga->dni }}</td>
                    <td>{{ $recarga->patente }}</td>
                    <td>{{ $recarga->importe }}</td>
                    <td>{{ $recarga->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
