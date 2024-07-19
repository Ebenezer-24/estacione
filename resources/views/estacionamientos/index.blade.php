@extends('layouts.app')

@section('content')
    <h1>Espacios de Estacionamiento</h1>
    <a href="{{ route('estacionamientos.create') }}" class="btn btn-primary">Registrar Nuevo Estacionamiento</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Espacio</th>
                <th>Estado</th>
                <th>Patente</th>
                <th>Tiempo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estacionamientos as $estacionamiento)
                <tr>
                    <td>{{ $estacionamiento->id }}</td>
                    <td>{{ $estacionamiento->estado }}</td>
                    <td>{{ $estacionamiento->patente }}</td>
                    <td>{{ $estacionamiento->tiempo }}</td>
                    <td>
                        @if($estacionamiento->estado == 'Estacionado')
                            <a href="{{ route('estacionamientos.edit', $estacionamiento) }}" class="btn btn-warning btn-sm">Editar</a>
                            <button class="btn btn-danger btn-sm btn-liberar" data-patente="{{ $estacionamiento->patente }}" data-espacio="{{ $estacionamiento->id }}">Liberar</button>
                        @else
                            <span>No disponible</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div id="modalLiberar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLiberarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-liberar" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLiberarLabel">Liberar Espacio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ingrese su contraseña para liberar el espacio.</p>
                        <input type="hidden" name="patente" id="modal-patente">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Liberar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.btn-liberar');
            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const patente = this.getAttribute('data-patente');
                    const espacio = this.getAttribute('data-espacio');
                    document.getElementById('modal-patente').value = patente;
                    document.getElementById('form-liberar').action = `/estacionamientos/${espacio}/liberar`;
                    $('#modalLiberar').modal('show');
                });
            });
        });
    </script>
@endsection
