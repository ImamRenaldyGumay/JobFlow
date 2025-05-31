<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JobFlow')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-64">
            <!-- Header -->
            @include('partials.header')
            <!-- Page Content -->
            <main class="flex-1 p-2 sm:p-4 md:p-8 bg-gray-50 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('modals')
    @stack('scripts')
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#2563eb',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
</body>

</html>