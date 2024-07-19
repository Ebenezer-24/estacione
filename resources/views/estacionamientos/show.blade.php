@extends('layouts.app')

@section('content')
    <h1>Estacionamiento {{ $estacionamiento->patente }}</h1>
    <p>Estado: {{ $estacionamiento->estado }}</p>
    <p>Tiempo: {{ $estacionamiento->tiempo }} minutos</p>
@endsection
