const energia = document.getElementById("energy");
const animo = document.getElementById("animo");
const nota = document.getElementById("nota");
const idmood = document.getElementById("idmood");
const btnMood = document.getElementById("btnGuardarMood");

//cargar tabla de mood
document.addEventListener("DOMContentLoaded", () => {
    cargarMood();
});

function cargarMood() {
    fetch("/mood/getdata")
        .then((res) => res.json())
        .then((data) => {
            const tbody = document.querySelector("#mood-table tbody");
            tbody.innerHTML = "";

            data.forEach((row) => {
                tbody.innerHTML += `
                    <tr>
                        <td>${row.energia}</td>
                        <td>${row.animo}</td>
                        <td>${row.nota}</td>
                        <td>
                        <button class="btn btn-warning btn-sm" onclick="editarMood(${row.idMood})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="confirmarEliminar(${row.idMood})">Eliminar</button>
                    </td>

                    </tr>
                `;
            });
            $("#mood-table").DataTable();
        });
}

//Abrir modal para guardar

window.nuevomood = function () {
    document.querySelector("#modalMood .modal-title").innerText = "Nuevo Mood";

    btnMood.innerText = "Guardar Mood";

    idmood.value = "";
    energia.value = "";
    animo.value = "";
    nota.value = "";

    btnMood.onclick = guardar;

    new bootstrap.Modal(document.getElementById("modalMood")).show();
};

//abrir modal para editar
window.editarMood = function (id) {
    fetch("/mood/get/" + id)
        .then((res) => res.json())
        .then((r) => {
            document.querySelector("#modalMood .modal-title").innerText =
                "Editar Mood";

            btnMood.innerText = "Actualizar Mood";
            idmood.value = r.idMood;
            energia.value = r.energia;
            animo.value = r.animo;
            nota.value = r.nota;

            btnMood.onclick = confirmarActualizar;

            new bootstrap.Modal(document.getElementById("modalMood")).show();
        });
};

//guardar el mood
function guardar() {
    fetch("/mood/insertar", {
        method: "POST",
        headers: {
            "content-type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            energia: energia.value,
            animo: animo.value,
            nota: nota.value,
        }),
    })
        .then((res) => res.json())
        .then((r) => {
            if (r.Exito == 1) {
                new PNotify({
                    title: "Correcto",
                    text: "Mood guardado correctamente",
                    type: "success",
                    delay: 2000,
                });
                cargarMood();
            } else {
                new PNotify({
                    title: "Error",
                    text: "No se pudo guardar el Mood",
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

//actualizar el Mood
function actualizar() {
    fetch("/mood/act/" + idmood.value, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            energia: energia.value,
            animo: animo.value,
            nota: nota.value,
        }),
    })
        .then((res) => res.json())
        .then((r) => {
            if (r.Exito == 1) {
                new PNotify({
                    title: "Correcto",
                    text: "Mood actualizado correctamente",
                    type: "success",
                });
                cargarMood();
            }
        });
}

function confirmarActualizar() {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Se actualizará el registro del Mood",
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



//Eliminar Mood

function eliminarMood(id) {
    fetch("/mood/eliminar/" + id, {
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
                    text: "Mood eliminado correctamente",
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false,
                });
                cargarMood();
            } else {
                Swal.fire("Error", "No se pudo eliminar el Mood", "error");
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
            eliminarMood(id);
        }
    });
}
