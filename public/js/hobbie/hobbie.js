const juego = document.getElementById("game");
const tipo = document.getElementById("tipoJuego");
const sesion = document.getElementById("sesion");
const nota = document.getElementById("nota");
const idhobbie = document.getElementById("idHobbie");
const btn = document.getElementById("btnGuardarHobbie");

//cargar tabla de hobbie
document.addEventListener("DOMContentLoaded", () => {
    cargarHobbie();
});

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
                        <button class="btn btn-warning btn-sm" onclick="editarHobbie(${row.idHobby})"">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="confirmarEliminar(${row.idHobby})">Eliminar</button>
                    </td>

                    </tr>
                `;
            });
            $("#hobbie-table").DataTable();
        });
}

//Abrir modal para guardar

window.nuevoHobbie = function () {
    document.querySelector("#modalHobbie .modal-title").innerText =
        "Nuevo Hobbie";

    btn.innerText = "Guardar Hobbie";

    idhobbie.value = "";
    juego.value = "";
    tipo.value = 0;
    sesion.value = 0;
    nota.value = "";

    btn.onclick = guardar;

    new bootstrap.Modal(document.getElementById("modalHobbie")).show();
};

//abrir modal para editar
window.editarHobbie = function (id) {
    fetch("/hobbies/get/" + id)
        .then((res) => res.json())
        .then((r) => {
            document.querySelector("#modalHobbie .modal-title").innerText =
                "Editar Hobbie";
                console.log(r);

            btn.innerText = "Actualizar Hobbie";
            idhobbie.value = r.idHobby;
            juego.value = r.nombreJuego;
            tipo.value = r.tipo;
            sesion.value = r.sesionMinutos;
            nota.value = r.nota;

            btn.onclick = confirmarActualizar;

            new bootstrap.Modal(document.getElementById("modalHobbie")).show();
        });
};

//guardar el hobbie
function guardar() {
    fetch("/hobbies/insertar", {
        method: "POST",
        headers: {
            "content-type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            nombreJuego: juego.value,
            tipo: tipo.value,
            sesionMinutos: sesion.value,
            nota: nota.value,
        }),
    })
        .then((res) => res.json())
        .then((r) => {
            if (r.Exito == 1) {
                new PNotify({
                    title: "Correcto",
                    text: "Hobbie guardado correctamente",
                    type: "success",
                    delay: 2000,
                });
                cargarHobbie();
            } else {
                new PNotify({
                    title: "Error",
                    text: "No se pudo guardar el Hobbie",
                    type: "error",
                });
            }
        })
        .catch(() => {
            new PNotify({
                title: "Error",
                text: "Error de conexión",
                type: "error",
            });
        });
}

//actualizar el Hobbie
function actualizar() {
    fetch("/hobbies/act/" + idhobbie.value, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            nombreJuego: juego.value,
            tipo: tipo.value,
            sesionMinutos: sesion.value,
            nota: nota.value,
        }),
    })
        .then((res) => res.json())
        .then((r) => {
            if (r.Exito == 1) {
                new PNotify({
                    title: "Correcto",
                    text: "Hobbie actualizado correctamente",
                    type: "success",
                });
                cargarHobbie();
            }
        });
}

function confirmarActualizar() {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Se actualizará el registro del Hobbie",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#0d6efd",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, actualizar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            actualizar();
        }
    });
}



//Eliminar Hobbie

function eliminarhobbie(id) {
    fetch("/hobbies/eliminar/" + id, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((res) => res.json())
        .then((r) => {
            if (r.Exito == 1) {
                Swal.fire({
                    title: "Eliminado",
                    text: "Hobbie eliminado correctamente",
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false,
                });
                cargarHobbie();
            } else {
                Swal.fire("Error", "No se pudo eliminar el Hobbie", "error");
            }
        });
}

function confirmarEliminar(id) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarhobbie(id);
        }
    });
}
