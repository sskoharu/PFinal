document.addEventListener("DOMContentLoaded", function () {
    var submitButton = document.getElementById("submitMedicoForm");

    if (submitButton) {
        submitButton.addEventListener("click", function (e) {
            e.preventDefault();
            var id = this.dataset.id;
            var data = {
                nombre: document.getElementById("nombre").value,
                especialidad: document.getElementById("especialidad").value,
                telefono: document.getElementById("telefono").value,
                email: document.getElementById("email").value
            };
            
            var url = id ? `/PFinal/Proyecto/controllers/medico.controller.php?op=actualizar&id=${id}` : "/PFinal/Proyecto/controllers/medico.controller.php?op=insertar";
            
            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
            .then(response => response.text()) 
            .then(text => {
                console.log("Respuesta del servidor:", text);  
                try {
                    var responseData = JSON.parse(text);
                    if (responseData.success) {
                        alert(`Médico ${id ? 'actualizado' : 'guardado'} exitosamente!`);
                        location.reload();
                    } else {
                        alert(`Error al ${id ? 'actualizar' : 'guardar'} el médico: ${responseData.message || 'Error desconocido'}`);
                    }
                } catch (error) {
                    console.error("Error de parseo JSON:", error);
                    alert("Ocurrió un error al procesar la respuesta del servidor.");
                }
            })
            .catch(error => console.error("Error en la solicitud:", error));
        });
    }

    document.querySelectorAll(".editMedico").forEach(function(button) {
        button.addEventListener("click", function () {
            var id = this.dataset.id;
            fetch("/PFinal/Proyecto/controllers/medico.controller.php?op=uno", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id: id }),
            })
            .then(response => response.text())  
            .then(text => {
                console.log("Respuesta del servidor:", text); 
                try {
                    var responseData = JSON.parse(text);
                    if (responseData) {
                        document.getElementById("nombre").value = responseData.nombre;
                        document.getElementById("especialidad").value = responseData.especialidad;
                        document.getElementById("telefono").value = responseData.telefono;
                        document.getElementById("email").value = responseData.email;
                        document.getElementById("submitMedicoForm").dataset.id = id;
                    } else {
                        alert("Error al cargar los datos del médico.");
                    }
                } catch (error) {
                    console.error("Error de parseo JSON:", error);
                    alert("Ocurrió un error al procesar la respuesta del servidor.");
                }
            })
            .catch(error => console.error("Error en la solicitud:", error));
        });
    });

    document.querySelectorAll(".deleteMedico").forEach(function(button) {
        button.addEventListener("click", function () {
            var id = this.dataset.id;
            
            // Mensaje de confirmación
            if (confirm("¿Estás seguro de que deseas eliminar este médico?")) {
                fetch(`/PFinal/Proyecto/controllers/medico.controller.php?op=eliminar&id=${id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    }
                })
                .then(response => response.text())  
                .then(text => {
                    console.log("Respuesta del servidor:", text); 
                    try {
                        var responseData = JSON.parse(text);
                        if (responseData.success) {
                            alert("Médico eliminado exitosamente!");
                            location.reload();
                        } else {
                            alert("Error al eliminar el médico: " + (responseData.message || "Error desconocido"));
                        }
                    } catch (error) {
                        console.error("Error de parseo JSON:", error);
                        alert("Ocurrió un error al procesar la respuesta del servidor.");
                    }
                })
                .catch(error => console.error("Error en la solicitud:", error));
            }
        });
    });
});
