const minutosHoyEl = document.getElementById("minutosHoy");
const porcentajeAutoEl = document.getElementById("porcentajeAuto");
const totalRegistrosEl = document.getElementById("totalRegistros");
const totalAutomatizadosEl = document.getElementById("totalAutomatizados");
const chart = document.getElementById("moodWorkChart");
const hobbiedayEl = document.getElementById("hobbieday");
const nohobbieEl = document.getElementById("nohobbie");
const insightTexto = document.getElementById("insightTexto");
const insightCard = document.getElementById("insightCard");

fetch("/dashboard/data")
    .then((res) => res.json())
    .then((d) => {
        minutosHoyEl.innerText = d.minutosHoy + " min";
        porcentajeAutoEl.innerText = d.porcentajeAuto + "%";
        totalRegistrosEl.innerText = d.totalRegistros;
        totalAutomatizadosEl.innerText = d.totalAutomatizados
            ? d.totalAutomatizados
            : 0;
    });

fetch("/dashboard/mood-work")
    .then((res) => res.json())
    .then((data) => {
        const labels = data.map((d) => d.fecha);
        const minutos = data.map((d) => d.minutosTotales);
        const energia = data.map((d) => d.energia);

        const ctx = chart.getContext("2d");

        new Chart(ctx, {
            data: {
                labels,
                datasets: [
                    {
                        type: "line",
                        label: "Energía",
                        data: energia,
                        tension: 0.3,
                        yAxisID: "y1",
                        backgroundColor: "blue",
                        borderColor: "blue",
                    },
                    {
                        type: "bar",
                        label: "Minutos trabajados",
                        data: minutos,
                        backgroundColor: "rgb(191, 36, 36,1)",
                        borderColor: "rgb(191, 36, 36,1)",
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Minutos",
                        },
                    },
                    y1: {
                        beginAtZero: true,
                        min: 0,
                        max: 100,
                        position: "right",
                        title: {
                            display: true,
                            text: "Energía",
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                    },
                },
            },
        });
    });

fetch("/dashboard/hobbyImpact")
    .then((res) => res.json())
    .then((data) => {
        // valores por defecto
        let conHobby = 0;
        let sinHobby = 0;

        data.forEach((r) => {
            if (r.tieneHobby == 1) {
                conHobby = Math.round(r.promedioMinutos);
            } else {
                sinHobby = Math.round(r.promedioMinutos);
            }
        });
        hobbiedayEl.innerText = conHobby + " min";
        nohobbieEl.innerText = sinHobby + " min";
    });

fetch("/dashboard/insight")
    .then((r) => r.json())
    .then((d) => {
        insightTexto.innerText = d.INSIGHT;

        if (d.INSIGHT.includes("no registraste")) {
            insightCard.classList.add("bg-secondary");
            insightTexto.classList.add("text-white");
        } else {
            insightCard.classList.add("bg-success");
            insightTexto.classList.add("text-black");
        }
    });
