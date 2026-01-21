@extends('layout.app')

@section('content')
<h2>WorkLog</h2>

<table class="table table-bordered" id="worklog-table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Actividad</th>
            <th>Tiempo</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
@endsection

@push('scripts')
    <script>
        fetch('/worklogs')
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector('#worklog-table tbody');

            data.forEach(row => {
                tbody.innerHTML += `
                <tr>
                    <td>${row.fecha}</td>
                    <td>${row.actividad}</td>
                    <td>${row.tiempo}</td>
                </tr>
                `;

            });
        });
    </script>
@endpush