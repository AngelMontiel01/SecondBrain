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

    <div class="row mt-4">
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
    <script>
        fetch('/dashboard/data')
            .then(res => res.json())
            .then(d => {
                document.getElementById('minutosHoy').innerText = d.minutosHoy + ' min';
                document.getElementById('porcentajeAuto').innerText = d.porcentajeAuto + '%';
                document.getElementById('totalRegistros').innerText = d.totalRegistros;
                document.getElementById('totalAutomatizados').innerText = d.totalAutomatizados;
            });

        fetch('/dashboard/mood-work')
            .then(res => res.json())
            .then(data => {

                const labels = data.map(d => d.fecha);
                const minutos = data.map(d => d.minutosTotales);
                const energia = data.map(d => d.energia);

                const ctx = document
                    .getElementById('moodWorkChart')
                    .getContext('2d');

                new Chart(ctx, {
                    data: {
                        labels,
                        datasets: [{
                                type: 'line',
                                label: 'Energía',
                                data: energia,
                                tension: 0.3,
                                yAxisID: 'y1',
                                backgroundColor: 'blue',
                                borderColor: 'blue',

                            },
                            {

                                type: 'bar',
                                label: 'Minutos trabajados',
                                data: minutos,
                                backgroundColor: 'rgb(191, 36, 36,1)',
                                borderColor: 'rgb(191, 36, 36,1)',
                            },

                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Minutos'
                                }
                            },
                            y1: {
                                beginAtZero: true,
                                min: 0,
                                max: 100,
                                position: 'right',
                                title: {
                                    display: true,
                                    text: 'Energía'
                                },
                                grid: {
                                    drawOnChartArea: false
                                }
                            }
                        }
                    }
                });
            });

        fetch('/dashboard/hobbyImpact')
            .then(res => res.json())
            .then(data => {

                // valores por defecto
                let conHobby = 0;
                let sinHobby = 0;

                data.forEach(r => {
                    if (r.tieneHobby == 1) {
                        conHobby = Math.round(r.promedioMinutos);
                    } else {
                        sinHobby = Math.round(r.promedioMinutos);
                    }
                });

                document.getElementById('hobbieday').innerText =
                    conHobby + ' min';

                document.getElementById('nohobbie').innerText =
                    sinHobby + ' min';
            });
    </script>
@endpush
