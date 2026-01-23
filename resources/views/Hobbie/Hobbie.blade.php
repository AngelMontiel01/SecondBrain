@extends('layout.app')

@section('content')
    <h2>Hobbies</h2>
    <div class="p-1">
        <button class="btn btn-primary" onclick="nuevoHobbie()">
            + Nuevo Hobbie
        </button>
    </div>

    <div class="mt-5 modal fade" id="modalHobbie">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registro Hobbie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" id="idHobbie">
                <div class="modal-body">
                    <span for="game">Nombre del juego</span>
                    <input type="text" id="game" class="form-control mb-2">
                    <span for="tipoJuego">Tipo de Juego</span>
                    <select id="tipoJuego" class="form-control mb-2">
                        <option value="1">Arcade</option>
                        <option value="3">Shotter</option>
                        <option value="2">RPG</option>
                    </select>
                    <span for="sesion">Sesion</span>
                    <input type="number" id="sesion" class="form-control mb-2">
                    <span for="nota">Nota</span>
                    <textarea name="nota" id="nota" class="form-control mb-2"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarHobbie">Guardar Juego</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tabla mt-3">
        <table class="table table-bordered" id="hobbie-table"></table>
        <thead>
            <tr>
                <th>Juego</th>
                <th>Tipo de Juego</th>
                <th>Sesion</th>
                <th>Nota</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>

    </div>
@endsection
