<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div>
        <div class="bg-success">
            <div class="container py-4">
                <h1 class="text-center text-white text-header">ZEIN MADING</h1>
            </div>
        </div>

        @include('layouts.navbar')

        <div class="container mt-5">
            {{ $slot }}
        </div>
    </div>


    @include('layouts.footer')

    <script>
        function preview(preview, foto) {
            alert("hello");
            document.querySelector(preview).src = URL.createObjectURL(document.querySelector(foto).files[0]);
            document.querySelector(preview).classList.remove("d-none");
        }
    </script>
</body>

</html>
