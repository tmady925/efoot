<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Inscription')</title>

    {{-- Utilisation de Laravel Mix --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">
        <!-- Header avec image de fond -->
        <div class="page-header page-header-small relative">
            <div class="page-header-image absolute inset-0 z-0 bg-cover bg-center"
                style="background-image: url('{{ asset('frontend/assets/img/header-bg.jpg') }}');">
            </div>
            <div class="relative z-10 py-16 bg-black bg-opacity-50">
                <div class="container mx-auto text-center text-white">
                    <h1 class="text-4xl font-bold">@yield('page-title', 'Inscription')</h1>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <main class="py-6">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
