<!DOCTYPE html>
<html>
<head>
    <title>Estacionamiento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('estacionamientos.index') }}">Estacionamientos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('comercios.index') }}">Comercios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recargas.index') }}">Recargas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pagos_comercios.index') }}">Pago Comercios</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    @yield('scripts')
</body>
</html>
