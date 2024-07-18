document.addEventListener("DOMContentLoaded", function () {
    var submitButton = document.getElementById("submitConsultaForm");

    if (submitButton) {
        submitButton.addEventListener("click", function (e) {
            e.preventDefault();
            var id = this.dataset.id;
            var data = {
                paciente_id: document.getElementById("paciente_id").value,
                medico_id: document.getElementById("medico_id").value,
                fecha: document.getElementById("fecha").value,
                descripcion: document.getElementById("descripcion").value
            };
            
            var url = id ? `/PFinal/Proyecto/controllers/consulta.controller.php?op=actualizar&id=${id}` : "/PFinal/Proyecto/controllers/consulta.controller.php?op=insertar";
            
            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`Consulta ${id ? 'actualizada' : 'guardada'} exitosamente!`);
                    // Actualizar la tabla o contenido dinámicamente si es necesario
                    location.reload(); // O actualizar la tabla dinámicamente en lugar de recargar
                } else {
                    alert(`Error al ${id ? 'actualizar' : 'guardar'} la consulta: ${data.message}`);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Ocurrió un error al realizar la solicitud.");
            });
        });
    }

    document.querySelectorAll(".editConsulta").forEach(function(button) {
        button.addEventListener("click", function () {
            var id = this.dataset.id;
            fetch("/PFinal/Proyecto/controllers/consulta.controller.php?op=uno", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id: id }),
            })
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById("paciente_id").value = data.paciente_id;
                    document.getElementById("medico_id").value = data.medico_id;
                    document.getElementById("fecha").value = data.fecha;
                    document.getElementById("descripcion").value = data.descripcion;
                    document.getElementById("submitConsultaForm").dataset.id = id;
                    document.getElementById("paciente_id").disabled = true;
                } else {
                    alert("Error al cargar los datos de la consulta.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Ocurrió un error al cargar los datos de la consulta.");
            });
        });
    });

    document.querySelectorAll(".deleteConsulta").forEach(function(button) {
        button.addEventListener("click", function () {
            var id = this.dataset.id;
            if (confirm("¿Estás seguro de que deseas eliminar esta consulta?")) {
                fetch(`/PFinal/Proyecto/controllers/consulta.controller.php?op=eliminar&id=${id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Consulta eliminada exitosamente!");
                        // Actualizar la tabla o contenido dinámicamente si es necesario
                        location.reload(); // O actualizar la tabla dinámicamente en lugar de recargar
                    } else {
                        alert("Error al eliminar la consulta: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Ocurrió un error al eliminar la consulta.");
                });
            }
        });
    });
});
