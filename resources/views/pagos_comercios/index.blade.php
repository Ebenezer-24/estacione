@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pagos Comercios</h1>
        <a href="{{ route('pagos_comercios.create') }}" class="btn btn-primary">Crear Pago Comercio</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Comercio</th>
                    <th>Fecha Desde</th>
                    <th>Fecha Hasta</th>
                    <th>Importe</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pagoComercios as $pagoComercio)
                    <tr>
                        <td>{{ $pagoComercio->id }}</td>
                        <td>{{ $pagoComercio->comercio->razon_social }}</td>
                        <td>{{ $pagoComercio->fecha_desde }}</td>
                        <td>{{ $pagoComercio->fecha_hasta }}</td>
                        <td>{{ $pagoComercio->importe }}</td>
                        <td>
                            <a href="{{ route('pagos_comercios.show', $pagoComercio->id) }}" class="btn btn-info">Ver</a>
                          
                            <form action="{{ route('pagos_comercios.destroy', $pagoComercio->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
