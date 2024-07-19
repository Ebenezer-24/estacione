@extends('layouts.app')

@section('content')
    <h1>Editar Estacionamiento</h1>
    <form action="{{ route('estacionamientos.update', $estacionamiento) }}" method="POST">
        @csrf
        @method('PUT')
        <select name="estado">
            <option value="Estacionado" {{ $estacionamiento->estado == 'Estacionado' ? 'selected' : '' }}>Estacionado</option>
            <option value="Libre" {{ $estacionamiento->estado == 'Libre' ? 'selected' : '' }}>Libre</option>
        </select>
        <input type="number" name="tiempo" value="{{ $estacionamiento->tiempo }}" placeholder="Tiempo (en minutos)">
        <button type="submit">Actualizar</button>
    </form>
@endsection
