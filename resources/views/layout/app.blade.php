<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecondBrain</title>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>


    {{-- Soft UI CSS --}}
    <link href="{{ asset('assets/css/soft-ui-dashboard.css') }}" rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">


    @stack('styles')
</head>

<body class="g-sidenav-show bg-gray-100">

    {{-- SIDEBAR --}}
    @include('layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        {{-- NAVBAR --}}
        @include('layout.navbar')

        <div class="container-fluid py-4">
            @yield('content')
        </div>

    </main>

    {{-- JS CORE --}}
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/soft-ui-dashboard.min.js') }}"></script>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- jQuery (DataTables lo necesita) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    {{-- Scripts por vista --}}
    @stack('scripts')

</body>

</html>
