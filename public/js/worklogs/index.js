const fecha = document.getElementById("fecha");
const tipoDia = document.getElementById("tipoDia");
const actividad = document.getElementById("actividad");
const automatizacion = document.getElementById("automatizacion");
const horas = document.getElementById("horas");
const minutos = document.getElementById("minutos");
const idWorklog = document.getElementById("idWorklog");
const btnGuardar = document.getElementById("btnGuardarWorklog");

//function para abrir en modo Crear
window.nuevoWorklog = function () {
    document.querySelector("#modalWorkLog .modal-title").innerText =
        "Nuevo WorkLog";
    btnGuardar.innerText = "Guardar Registro";

    idWorklog.value = "";
    fecha.value = "";
    tipoDia.value = 1;
    actividad.value = "";
    automatizacion.value = 0;
    horas.value = 0;
    minutos.value = 0;

    btnGuardar.onclick = guardar;

    new bootstrap.Modal(document.getElementById("modalWorkLog")).show();
};

window.editarWorklog = function (id) {
    fetch("/worklogs/get/" + id)
        .then((res) => res.json())
        .then((r) => {
            document.querySelector("#modalWorkLog .modal-title").innerText =
                "Editar WorkLog";
            btnGuardar.innerText = "Actualizar Registro";

            idWorklog.value = r.idWork;
            fecha.value = r.fecha;
            tipoDia.value = r.tipoDia;
            actividad.value = r.actividad;
            automatizacion.value = r.automatizacion;

            const [h, m] = r.tiempoReal.split(":");
            horas.value = parseInt(h);
            minutos.value = parseInt(m);

            btnGuardar.onclick = actualizar;

            new bootstrap.Modal(document.getElementById("modalWorkLog")).show();
        });
};

function getTiempoReal() {
    const h = parseInt(horas.value) || 0;
    const m = parseInt(minutos.value) || 0;

    return `${String(h).padStart(2, "0")}:${String(m).padStart(2, "0")}:00`;
}

function formatTiempo(t) {
    const [h, m] = t.split(":").map(Number);

    if (h > 0) {
        return `${h} hr con ${m} min`;
    }
    return `${m} min`;
}

fetch("/worklogs/getdata")
    .then((res) => res.json())
    .then((data) => {
        const tbody = document.querySelector("#worklog-table tbody");

        data.forEach((row) => {
            let tipo = Number(row.tipoDia);
            if (tipo === 1) {
                row.tipoDia = "Día Laboral";
            } else {
                row.tipoDia = "Fin de semana";
            }

            let auto = Number(row.automatizacion);
            if (auto === 1) {
                row.automatizacion = "✅ ";
            } else {
                row.automatizacion = "❌ ";
            }

            tbody.innerHTML += `
                <tr>
                    <td>${row.fecha}</td>
                    <td>${row.tipoDia}</td>
                    <td>${row.actividad}</td>
                    <td>${row.automatizacion}</td>
                    <td>${formatTiempo(row.tiempoReal)}</td>
                    <td>
                        <button class="btn btn-warning" onclick="editarWorklog(${row.idWork})">Editar</button>
                        <button class="btn btn-danger" onclick="eliminarWorklog(${row.idWork})">Eliminar</button>
                    </td>
                </tr>
                `;
        });
    });

function guardar() {
    fetch("/worklogs/insert", {
        method: "POST",
        headers: {
            "content-type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            fecha: fecha.value,
            tipoDia: tipoDia.value,
            actividad: actividad.value,
            automatizacion: automatizacion.value,
            tiempoReal: getTiempoReal(),
        }),
    })
        .then((res) => res.json())
        .then((r) => {
            if (r.Exito == 1) {
                new PNotify({
                    title: "Correcto",
                    text: "WorkLog guardado correctamente",
                    type: "success",
                    delay: 2000,
                });

                setTimeout(() => location.reload(), 600);
            } else {
                new PNotify({
                    title: "Error",
                    text: "No se pudo guardar el WorkLog",
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

function actualizar() {
    fetch("/worklogs/update/" + idWorklog.value, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            fecha: fecha.value,
            tipoDia: tipoDia.value,
            actividad: actividad.value,
            automatizacion: automatizacion.value,
            tiempoReal: getTiempoReal(),
        }),
    })
        .then(res => res.json())
        .then(r => {
            if (r.Exito == 1) {
                new PNotify({
                    title: "Correcto",
                    text: "WorkLog actualizado correctamente",
                    type: "success",
                });
                setTimeout(() => location.reload(), 500);
            }
        });
}

function eliminarWorklog(id) {
    fetch("/worklogs/delete/" + id, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            id,
        }),
    })
        .then((res) => res.json())
        .then((r) => {
            if (r.Exito == 1) {
                new PNotify({
                    title: "Atención",
                    text: "WorkLog eliminado correctamente",
                    type: "warning",
                    delay: 2000,
                });

                setTimeout(() => location.reload(), 600);
            } else {
                new PNotify({
                    title: "Error",
                    text: "No se pudo eliminar el WorkLog",
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
