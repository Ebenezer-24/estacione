@extends('layouts.app')

@section('content')
    <h1>Editar Comercio</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('comercios.update', $comercio) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cuit">CUIT</label>
            <input type="text" name="cuit" id="cuit" class="form-control" value="{{ old('cuit', $comercio->cuit) }}" required>
        </div>
        <div class="form-group">
            <label for="razon_social">Razón Social</label>
            <input type="text" name="razon_social" id="razon_social" class="form-control" value="{{ old('razon_social', $comercio->razon_social) }}" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $comercio->direccion) }}" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="autorizado" {{ $comercio->estado == 'autorizado' ? 'selected' : '' }}>Autorizado</option>
                <option value="suspendido" {{ $comercio->estado == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('comercios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
