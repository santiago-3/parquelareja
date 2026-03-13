<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    
    <!-- Custom CSS -->
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- Header Section -->
    <header>
        @include('partials.navigation')
    </header>

    <!-- Main Content Area -->
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        @include('partials.footer')
    </footer>

    <!-- Scripts -->
    
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Stack for page-specific scripts -->
    @stack('scripts')
</body>
</html>
