<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Paciente</title>
</head>
<body>
    <h1>Formulario de Paciente</h1>
    <form id="patientForm">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br>
        <label for="direccion">Dirección</label>
        <input type="date" id="direccion" name="direccion" required>
        <br>
        <label for="telefono">Telefono</label>
        <input type="text" id="telefono" name="telefono" required>
        <br>
        <button type="submit" id="submitPatientForm">Guardar</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="../../public/js/pacientes.js"></script>
</body>
</html>
