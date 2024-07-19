@extends('layouts.app')

@section('content')
    <h1>Agregar Recarga</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recargas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="comercio_id">Comercio</label>
            <select name="comercio_id" id="comercio_id" class="form-control" required>
                <option value="">Seleccione un comercio</option>
                @foreach($comercios as $comercio)
                    <option value="{{ $comercio->id }}" {{ old('comercio_id') == $comercio->id ? 'selected' : '' }}>
                        {{ $comercio->razon_social }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="number" name="dni" id="dni" class="form-control" value="{{ old('dni') }}" required>
        </div>
        <div class="form-group">
            <label for="patente">Patente</label>
            <input type="text" name="patente" id="patente" class="form-control" value="{{ old('patente') }}" required>
        </div>
        <div class="form-group">
            <label for="importe">Importe</label>
            <input type="number" name="importe" id="importe" class="form-control" step="0.01" value="{{ old('importe') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('recargas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
