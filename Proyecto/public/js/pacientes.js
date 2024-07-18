document.addEventListener("DOMContentLoaded", function () {
    var submitButton = document.getElementById("submitPatientForm");

    if (submitButton) {
        submitButton.addEventListener("click", function (e) {
            e.preventDefault();
            var id = this.dataset.id;
            var data = {
                nombre: document.getElementById("nombre").value,
                apellido: document.getElementById("apellido").value,
                direccion: document.getElementById("direccion").value,
                telefono: document.getElementById("telefono").value,
            };
            
            var url = id ? `/PFinal/Proyecto/controllers/paciente.controller.php?op=actualizar&id=${id}` : "/PFinal/Proyecto/controllers/paciente.controller.php?op=insertar";
            
            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
            .then(response => response.text())  
            .then(text => {
                console.log(text);  
                try {
                    var data = JSON.parse(text);
                    if (data.success) {
                        alert(`Paciente ${id ? 'actualizado' : 'guardado'} exitosamente!`);
                        location.reload();
                    } else {
                        alert(`Error al ${id ? 'actualizar' : 'guardar'} el paciente.`);
                    }
                } catch (error) {
                    console.error("Error de parseo JSON:", error);
                    console.error("Respuesta del servidor:", text);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    }

    document.querySelectorAll(".editPatient").forEach(function(button) {
        button.addEventListener("click", function () {
            var id = this.dataset.id;
            fetch("/PFinal/Proyecto/controllers/paciente.controller.php?op=uno", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id: id }),
            })
            .then(response => response.text()) 
            .then(text => {
                console.log(text);  
                try {
                    var data = JSON.parse(text);
                    if (data) {
                        var nombreInput = document.getElementById("nombre");
                        var apellidoInput = document.getElementById("apellido");
                        var direccionInput = document.getElementById("direccion");
                        var telefonoInput = document.getElementById("telefono");
                        
                        if (nombreInput && apellidoInput && direccionInput && telefonoInput) {
                            nombreInput.value = data.nombre;
                            apellidoInput.value = data.apellido;
                            direccionInput.value = data.direccion;
                            telefonoInput.value = data.telefono;
                            document.getElementById("submitPatientForm").dataset.id = id;
                        } else {
                            console.error("Elementos del formulario no encontrados");
                        }
                    } else {
                        alert("Error al cargar los datos del paciente.");
                    }
                } catch (error) {
                    console.error("Error de parseo JSON:", error);
                    console.error("Respuesta del servidor:", text);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });

    document.querySelectorAll(".deletePatient").forEach(function(button) {
        button.addEventListener("click", function () {
            var id = this.dataset.id;
            var confirmDelete = window.confirm("¿Estás seguro de que deseas eliminar este paciente?");
            if (confirmDelete) {
                fetch(`/PFinal/Proyecto/controllers/paciente.controller.php?op=eliminar&id=${id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    }
                })
                .then(response => response.text()) 
                .then(text => {
                    console.log(text);  
                    try {
                        var data = JSON.parse(text);
                        if (data.success) {
                            alert("Paciente eliminado exitosamente!");
                            location.reload();
                        } else {
                            alert("Error al eliminar el paciente.");
                        }
                    } catch (error) {
                        console.error("Error de parseo JSON:", error);
                        console.error("Respuesta del servidor:", text);
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});
