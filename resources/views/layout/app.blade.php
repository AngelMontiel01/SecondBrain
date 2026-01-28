<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecondBrain</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.css" />
  
    
    
    <style>
        #sidebar {
            min-height: 100vh;
            border-right: 1px solid #dee2e6;
            background-color: #dee2e6 !important;
        }
        
        #sidebar .nav-link {
            color: #333;
        }
        
        #sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 0.375rem;
        }
        </style>
</head>

<body>
    
    @include('layout.navbar')
    
    <div class="container-fluid">
        <div class="row">

            {{-- SIDEBAR --}}
            <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">SecondBrain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    @include('layout.sidebar')
                </div>
            </div>
            
            
            
            {{-- CONTENT --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4 container-fluid">
                @yield('content')
            </main>
            
        </div>
    </div>
    
    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- PNotify --}}
    <link rel="stylesheet" href="https://unpkg.com/pnotify@3/dist/pnotify.css">
    <link rel="stylesheet" href="https://unpkg.com/pnotify@3/dist/pnotify.brighttheme.css">
    <script src="https://unpkg.com/pnotify@3/dist/pnotify.js"></script>
    <script src="https://unpkg.com/pnotify@3/dist/pnotify.buttons.js"></script>
    {{-- DataTable --}}
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.js"></script>

    {{-- charts.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>

</html>
