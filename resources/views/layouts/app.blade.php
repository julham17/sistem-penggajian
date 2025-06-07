<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistem Penggajian') }}</title>

    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Header --}}
    @isset($header)
        <header class="bg-white border-bottom shadow-sm mb-3">
            <div class="container py-3">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Content --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Script dari setiap halaman --}}
    @stack('scripts')

</body>
</html>
