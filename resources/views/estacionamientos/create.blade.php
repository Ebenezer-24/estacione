@extends('layouts.app')

@section('content')
    <h1>Registrar Estacionamiento</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('estacionamientos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="patente">Patente</label>
            <input type="text" name="patente" id="patente" class="form-control" placeholder="Patente" value="{{ old('patente') }}" required>
        </div>
        <div class="form-group">
            <label for="espacio">Espacio de Estacionamiento</label>
            <select name="espacio" id="espacio" class="form-control" required>
                @foreach($estacionamientos as $estacionamiento)
                    <option value="{{ $estacionamiento->id }}" {{ old('espacio') == $estacionamiento->id ? 'selected' : '' }}>
                        Espacio {{ $estacionamiento->id }} - {{ $estacionamiento->estado }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="Estacionado" {{ old('estado') == 'Estacionado' ? 'selected' : '' }}>Estacionado</option>
                <option value="Libre" {{ old('estado') == 'Libre' ? 'selected' : '' }}>Libre</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tiempo">Tiempo (en minutos)</label>
            <input type="number" name="tiempo" id="tiempo" class="form-control" placeholder="Tiempo (en minutos)" value="{{ old('tiempo') }}" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('estacionamientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
