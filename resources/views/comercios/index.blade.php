@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Comercios</h1>
        <a href="{{ route('comercios.create') }}" class="btn btn-primary">Agregar Comercio</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>CUIT</th>
                <th>Razón Social</th>
                <th>Dirección</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comercios as $comercio)
                <tr>
                    <td>{{ $comercio->cuit }}</td>
                    <td>{{ $comercio->razon_social }}</td>
                    <td>{{ $comercio->direccion }}</td>
                    <td>{{ $comercio->estado }}</td>
                    <td>
                        <a href="{{ route('comercios.show', $comercio) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('comercios.edit', $comercio) }}" class="btn btn-warning btn-sm">Editar</a>
                        @if ($comercio->estado !== 'suspendido')
                            <form action="{{ route('comercios.destroy', $comercio) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Suspender</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
