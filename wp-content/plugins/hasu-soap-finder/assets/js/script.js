document.addEventListener("DOMContentLoaded", function () {

    const btnBuscar = document.getElementById("hasu-buscar");
    const resultado = document.getElementById("hasu-resultado");

    function mostrarResultado(data, piel, beneficio) {

        const ingrediente = data.data.ingrediente;
        const descripcion = data.data.descripcion;
        const beneficios = data.data.beneficios;

        let listaBeneficios = "";

        beneficios.forEach(function (item) {
            listaBeneficios += `<li>${item}</li>`;
        });

        resultado.innerHTML = `
<div class="hasu-card">

    <h3> JABÓN RECOMENDADO</h3>

    <div class="hasu-ingrediente">${ingrediente}</div>

    <hr>

    <h4> Información del ingrediente</h4>

    <p class="hasu-desc">
        ${descripcion}
    </p>

    <hr>

    <h4> Beneficios para la piel</h4>

    <ul class="hasu-beneficios">
        ${listaBeneficios}
    </ul>

 

</div>
`;

        document.getElementById("hasu-refresh").addEventListener("click", function () {

            this.textContent = "Actualizando...";

            fetch(hasu_ajax.ajax_url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: new URLSearchParams({
                    action: "hasu_get_recommendation",
                    piel: piel,
                    beneficio: beneficio
                })
            })
            .then(response => response.json())
            .then(data => {

                if (!data.success) {
                    resultado.innerHTML = "<p>Error al actualizar la información.</p>";
                    return;
                }

                mostrarResultado(data, piel, beneficio);

            });

        });

    }

    btnBuscar.addEventListener("click", function () {

        const piel = document.getElementById("hasu-piel").value;
        const beneficio = document.getElementById("hasu-beneficio").value;

        resultado.innerHTML = "<p class='hasu-loading'> Buscando recomendación...</p>";

        fetch(hasu_ajax.ajax_url, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({
                action: "hasu_get_recommendation",
                piel: piel,
                beneficio: beneficio
            })
        })
        .then(response => response.json())
        .then(data => {

            if (!data.success) {
                resultado.innerHTML = "<p>Error al obtener la información.</p>";
                return;
            }

            mostrarResultado(data, piel, beneficio);

        });

    });

});