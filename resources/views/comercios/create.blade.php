@extends('layouts.app')

@section('content')
    <h1>Agregar Comercio</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('comercios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cuit">CUIT</label>
            <input type="text" name="cuit" id="cuit" class="form-control" value="{{ old('cuit') }}" required>
        </div>
        <div class="form-group">
            <label for="razon_social">Razón Social</label>
            <input type="text" name="razon_social" id="razon_social" class="form-control" value="{{ old('razon_social') }}" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('comercios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
