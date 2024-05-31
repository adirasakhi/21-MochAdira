<!DOCTYPE html>
<html class="scroll-smooth" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Detail Mobil - CarsXRent">
    <meta property="og:title" content="Detail Mobil - CarsXRent">
    <meta property="og:description" content="Detail lengkap mobil sewaan Anda di CarsXRent.">
    <meta property="og:image" content="{{ asset('asset/images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <title>@yield('title', 'CarXRent')</title>
    <link rel="shortcut icon" href="{{ asset('asset/images/logo.png') }}" type="image/x-icon">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

</head>

<body class="overflow-x-hidden">
    <x-navbar />

    <div class="container mx-auto px-8 mt-5 mb-32 lg:px-32">
        @yield('content')
    </div>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        // Panggil fungsi untuk menampilkan SweetAlert saat halaman dimuat
        window.onload = function() {
            // Periksa apakah ada pesan success dari controller
            @if(session('success'))
                showSuccessAlert('{{ session('success') }}');
            @endif

            // Periksa apakah ada pesan error dari controller
            @if(session('error'))
                showErrorAlert('{{ session('error') }}');
            @endif
        }

        // Fungsi untuk menampilkan SweetAlert dengan pesan success
        function showSuccessAlert(message) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: message,
                showConfirmButton: false,
                timer: 1500
            });
        }

        // Fungsi untuk menampilkan SweetAlert dengan pesan error
        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
</body>
</html>
