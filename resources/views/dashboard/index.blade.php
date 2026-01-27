@extends('layout.app')

@section('content')
<h3 class="mb-4">Dashboard</h3>

<div class="row g-3 text-center">
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
@endsection

@push('scripts')
<script>
fetch('/dashboard/data')
    .then(res => res.json())
    .then(d => {
        document.getElementById('minutosHoy').innerText = d.minutosHoy + ' min';
        document.getElementById('porcentajeAuto').innerText = d.porcentajeAuto + '%';
        ocument.getElementById('totalRegistros').innerText = d.totalRegistros;
        ocument.getElementById('totalAutomatizados').innerText =d.totalAutomatizados;
    });
</script>
@endpush
