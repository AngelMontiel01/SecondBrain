<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecondBrain</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/secondbrain">SecondBrain</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navSB">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navSB">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="/worklog">WorkLog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/moods">Mood</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/hobbies">Hooby</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module"></script>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- PNotify --}}
    <link rel="stylesheet" href="https://unpkg.com/pnotify@3/dist/pnotify.css">
    <link rel="stylesheet" href="https://unpkg.com/pnotify@3/dist/pnotify.brighttheme.css">
    <script src="https://unpkg.com/pnotify@3/dist/pnotify.js"></script>
    <script src="https://unpkg.com/pnotify@3/dist/pnotify.buttons.js"></script>

    @stack('scripts')
</body>

</html>
