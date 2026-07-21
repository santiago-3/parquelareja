<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin parque la reja</title>
    <link href="/css/admin.css" rel="stylesheet" type="text/css" />
    <style>
    </style>
</head>
<body>
    <header>
        <div>
        <h4>Parque la reja - Administración</h4>
        </div>
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        <div>
            {{ auth()->user()->name }} | <button onclick="logout()" class="button-anchor">logout</button>
        </div>
    </header>
    <div class="page admin-layout">
        <nav class="nav">
            <a href="{{ route('admin.reservations.index') }}">Reservas</a>
            <a href="{{ route('admin.activities.index') }}">Actividades</a>
            <a href="{{ route('admin.people.index') }}">Personas</a>
            <a href="{{ route('admin.places.index') }}">Lugares</a>
            <a href="{{ route('admin.states.index') }}">Estados</a>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        <form action="/logout" method="post">
            @csrf
        </form>
    </div>
</body>
</html>
<script>
    function logout() {
        document.querySelector('form').submit();
    }
</script>
