@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Pago Comercio</h1>
        <form action="{{ route('pagos_comercios.update', $pagoComercio->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="comercio_id">Comercio</label>
                <select name="comercio_id" id="comercio_id" class="form-control" required>
                    <option value="">Seleccione un comercio</option>
                    @foreach($comercios as $comercio)
                        <option value="{{ $comercio->id }}" {{ $pagoComercio->comercio_id == $comercio->id ? 'selected' : '' }}>
                            {{ $comercio->razon_social }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_desde">Fecha Desde</label>
                <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" value="{{ $pagoComercio->fecha_desde }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_hasta">Fecha Hasta</label>
                <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" value="{{ $pagoComercio->fecha_hasta }}" required>
            </div>
            <div class="form-group">
                <label for="importe">Importe</label>
                <input type="number" step="0.01" name="importe" id="importe" class="form-control" value="{{ $pagoComercio->importe }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
