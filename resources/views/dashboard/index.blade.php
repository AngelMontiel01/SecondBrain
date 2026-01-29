@extends('layout.app')

@section('content')
    <h3 class="mb-4">
        Dashboard {{ now()->locale('es')->isoFormat('ddd, D MMM YYYY') }}
    </h3>
    

    {{-- Resumen del Día --}}
    <div class="row mt-4 p-3">
        <div class="card" id="insightCard" style="background-color:#d8dee1">
            <div class="card-title text-center p-2 ">
                <span style="font-size: 25px; font-weight: bold;">Resumen del Día</span>
            </div>
            <div class="card-body text-center ">
                <span id="insightTexto" class="p-2" style="font-size: 30px"></span>
            </div>
        </div>
    </div>
    {{-- Resumen de Registros Automatizados --}}
    <div class="row g-3 text-center p-4">
        <div class="col-md-3">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h6>Tiempo Hoy</h6>
                    <h4 id="minutosHoy">0 min</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h6>% Automatización</h6>
                    <h4 id="porcentajeAuto">0%</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-secondary">
                <div class="card-body">
                    <h6>Registros Hoy</h6>
                    <h4 id="totalRegistros">0</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h6>Automatizados</h6>
                    <h4 id="totalAutomatizados">0</h4>
                </div>
            </div>
        </div>
    </div>
    {{-- Gráficos y Comparativas --}}
    <div class="row mt-4 p-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5>Mood vs Trabajo</h5>
                    <canvas id="moodWorkChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h6>Día con Hobby</h6>
                    <h4 id="hobbieday">0 min</h4>
                </div>
            </div>

            <div class="card text-bg-secondary">
                <div class="card-body">
                    <h6>Día sin Hobby</h6>
                    <h4 id="nohobbie">0 min</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/dash/dashboard.js') }}"></script>
@endpush
