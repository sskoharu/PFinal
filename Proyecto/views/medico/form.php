<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Medico</title>
</head>
<body>
    <h1>Formulario de Medico</h1>
    <form id="MedicoForm">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="especialidad">Especialidad:</label>
        <input type="text" id="especialidad" name="especialidad" required>
        <br>
        <label for="telefono">Telefono:</label>
        <input type="text" id="telefono" name="telefono" required>
        <br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <br>
        <button type="submit" id="submitMedicoForm">Guardar</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/PFinal/Proyecto/public/js/medicos.js"></script>
</body>
</html>