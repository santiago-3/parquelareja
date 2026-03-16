<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin CRUD</title>
    <style>
        .nav { background: #f4f4f4; padding: 1rem; margin-bottom: 2rem; }
        .nav a { margin-right: 15px; text-decoration: none; color: #333; }
        .alert { padding: 10px; margin-bottom: 10px; background: #d4edda; color: #155724; }
    </style>
</head>
<body>
    <nav class="nav">
        <strong>Menu:</strong>
        <a href="{{ route('admin.activities.index') }}">Activities</a>
        <a href="{{ route('admin.places.index') }}">Places</a> |
        <a href="{{ route('admin.people.index') }}">People</a> |
        <a href="{{ route('admin.states.index') }}">States</a> |
        <a href="{{ route('admin.reservations.index') }}">Reservations</a> |
        <a href="{{ route('admin.reservation-extras.index') }}">Reservation extras</a> |
        <a href="{{ route('admin.guests.index') }}">Guests</a> |
        <a href="{{ route('admin.price-items.index') }}">Price items</a> |
        +    </nav>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
