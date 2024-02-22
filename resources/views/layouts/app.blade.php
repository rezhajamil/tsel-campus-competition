<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Mendapatkan nama halaman Laravel saat ini
            var currentPage = "{{ Route::currentRouteName() }}";

            // Ubah konten div berdasarkan halaman yang aktif
            switch (currentPage) {
                case 'home':
                    $('#content').html('<p>Ini halaman beranda</p>');
                    break;
                case 'about':
                    $('#content').html('<p>Ini halaman tentang kami</p>');
                    break;
                    // Tambahkan kasus lain sesuai dengan halaman Anda
                default:
                    $('#content').html('<p>Halaman tidak ditemukan</p>');
            }
        });
    </script>

    <style>
        @font-face {
            font-family: 'Telkomsel Batik';
            src: url("{{ asset('fonts/TelkomselBatikSans-Bold.otf') }}");
        }

        .font-batik {
            font-family: 'Telkomsel Batik';
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->


        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
