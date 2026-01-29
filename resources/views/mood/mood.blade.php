@extends('layout.app')

@section('content')
    <h2>Mood</h2>
    <div class="p-1">
        <button class="btn btn-primary" onclick="nuevomood()">
            + Nuevo Mood
        </button>
    </div>

    <div class="mt-5 modal fade" id="modalMood">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registro Mood</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" id="idmood">
                <div class="modal-body">
                    <span for="energy">Energia</span>
                    <input type="number" min="0" max="10" id="energy" class="form-control mb-2">
                    <span for="animo">Animo</span>
                    <select name="animo" id="animo" class="form-control mb-2">
                        <option value="1">Muy Bajo</option>
                        <option value="2">Bajo</option>
                        <option value="3">Normal</option>
                        <option value="4">Alto</option>
                        <option value="5">Muy Alto</option>
                    </select>
                    <span for="fecha">Fecha</span>
                    <input type="date" id="fecha" class="form-control mb-2">
                    <span for="nota">Nota</span>
                    <textarea name="nota" id="nota" class="form-control mb-2"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarMood">Guardar mood</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="tabla mt-3">
                <table class="table table-bordered" id="mood-table">
                    <thead>
                        <tr>
                            <th>Energia</th>
                            <th>Animo</th>
                            <th>Fecha</th>
                            <th>Nota</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/mood/mood.js') }}"></script>
    @endpush
@endsection
