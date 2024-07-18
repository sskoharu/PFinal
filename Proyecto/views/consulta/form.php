<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Consulta</title>
</head>
<body>
    <h1>Formulario de Consulta</h1>
    <form id="consultaForm">
        <label for="paciente_id">Nombre del paciente:</label>
        <input type="text" id="paciente_id" name="paciente_id" required>
        <br>
        <label for="medico_id">Nombre del medico:</label>
        <input type="text" id="medico_id" name="medico_id" required>
        <br>
        <label for="fecha">Fecha de la Consulta:</label>
        <input type="datetime-local" id="fecha" name="fecha" required min="<?php echo date('Y-m-d\TH:i'); ?>">
        <br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required>
        <br>
        <button type="submit" id="submitConsultaForm">Guardar</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/PFinal/Proyecto/public/js/consultas.js"></script>
</body>
</html>
