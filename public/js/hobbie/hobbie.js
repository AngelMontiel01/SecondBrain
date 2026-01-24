const juego = document.getElementById("game");
const tipo = document.getElementById("tipoJuego");
const sesion = document.getElementById("sesion");
const nota = document.getElementById("nota");
const id = document.getElementById("idHobbie");
const btn = document.getElementById("btnGuardarHobbie");

//cargar tabla de hobbie
document.addEventListener("DOMContentLoaded", () => {
    cargarHobbie();
});

//Abrir modal

window.nuevoHobbie = function () {
    document.querySelector("#modalHobbie .modal-title").innerText =
        "Nuevo Hobbie";

    btn.innerText = "Guardar Hobbie";

    id.value = "";
    juego.value = "";
    tipo.value = 0;
    sesion.value = 0;
    nota.value = "";

    btn.onclick = guardar;

    new bootstrap.Modal(document.getElementById("modalHobbie")).show();
};

function cargarHobbie() {
    fetch("/hobbies/getdata")
        .then((res) => res.json())
        .then((data) => {
            const tbody = document.querySelector("#hobbie-table tbody");
            tbody.innerHTML = "";

            data.forEach((row) => {
                tbody.innerHTML += `
                    <tr>
                        <td>${row.nombreJuego}</td>
                        <td>${row.tipo}</td>
                        <td>${row.sesionMinutos}</td>
                        <td>${row.nota}</td>
                        <td>
                        <button class="btn btn-warning btn-sm" onclick="editarHobbie(${row.idHobbie})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="confirmarEliminar(${row.idHobbie})">Eliminar</button>
                    </td>

                    </tr>
                `;
            });
            $("#hobbie-table").DataTable();
        });
}

function editarHobbie(){

}

function confirmarEliminar(){}