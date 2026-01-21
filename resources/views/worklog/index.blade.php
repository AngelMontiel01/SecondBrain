@extends('layout.app')

@section('content')
    <h2>WorkLog</h2>
    <div class="p-1">
        <button class="btn btn-primary" onclick="nuevoWorklog()">
            + Nuevo Registro
        </button>
    </div>
    <div class="mt-5 modal fade" id="modalWorkLog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registro WorkLog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" id="idWorklog">
                <div class="modal-body">
                    <span for="fecha">Fecha</span>
                    <input type="date" id="fecha" class="form-control mb-2">
                    <span for="tipoDia">Tipo Día</span>
                    <select id="tipoDia" class="form-control mb-2">
                        <option value="1">Día Laboral</option>
                        <option value="2">Fin de semana</option>
                    </select>
                    <span for="actividad">Actividad</span>
                    <input type="text" id="actividad" class="form-control mb-2">
                    <span for="automatizacion">Automatización</span>
                    <select id="automatizacion" class="form-control mb-2">
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                    <div class="row">
                        <div class="col">
                            <label>Horas</label>
                            <input type="number" id="horas" class="form-control" min="0" value="0">
                        </div>
                        <div class="col">
                            <label>Minutos</label>
                            <input type="number" id="minutos" class="form-control" min="0" max="59"
                                value="0">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarWorklog">Guardar Registro</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="tabla mt-3">
        <table class="table table-bordered" id="worklog-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Tipo Día</th>
                    <th>Actividad</th>
                    <th>Automatización</th>
                    <th>Tiempo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/worklogs/index.js') }}"></script>
@endpush
