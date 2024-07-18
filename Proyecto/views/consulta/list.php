<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Consultas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1, h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        button.editConsulta {
            background-color: #2196F3;
        }

        button.deleteConsulta {
            background-color: #f44336;
        }

        button:hover {
            opacity: 0.8;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], input[type="datetime-local"], select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"], button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover, button[type="submit"]:hover {
            opacity: 0.8;
        }

        .error {
            color: red;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <h1>Listado de Consultas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Medico</th>
                <th>Fecha de la consulta</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ajusta la ruta según la estructura de tu proyecto
            $path = realpath(dirname(__FILE__) . '/../../config/conexion.php');
            if (file_exists($path)) {
                require_once($path);
            } else {
                die("Error: El archivo de conexión no se encontró en la ruta especificada.");
            }

            $con = new Clase_Conectar();
            $con = $con->Procedimiento_Conectar();
            $query = "SELECT 
            c.consulta_id, 
            p.nombre AS nombre_paciente, 
            d.nombre AS nombre_medico, 
            c.fecha, 
            c.descripcion 
          FROM consultas c
          JOIN pacientes p ON c.paciente_id = p.paciente_id
          JOIN medicos d ON c.medico_id = d.medico_id";
            $result = mysqli_query($con, $query);

            while ($fila = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila['consulta_id']); ?></td>
                    <td><?php echo htmlspecialchars($fila['nombre_paciente']); ?></td>
                    <td><?php echo htmlspecialchars($fila['nombre_medico']); ?></td>
                    <td><?php echo htmlspecialchars($fila['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
                    <td>
                        <button class="editConsulta" data-id="<?php echo htmlspecialchars($fila['consulta_id']); ?>">Editar</button>
                        <button class="deleteConsulta" data-id="<?php echo htmlspecialchars($fila['consulta_id']); ?>">Eliminar</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Formulario de Consultas</h2>
    <form id="consultaForm">
        <label for="paciente_id">Nombre del Paciente:</label>
        <select id="paciente_id" name="paciente_id" required>
            <?php
            $queryPacientes = "SELECT paciente_id, nombre FROM pacientes";
            $resultPacientes = mysqli_query($con, $queryPacientes);
            if (mysqli_num_rows($resultPacientes) > 0) {
                while ($paciente = mysqli_fetch_assoc($resultPacientes)) {
                    echo "<option value='" . htmlspecialchars($paciente['paciente_id']) . "'>" . htmlspecialchars($paciente['nombre']) . "</option>";
                }
            } else {
                echo "<option value=''>No hay pacientes disponibles</option>";
            }
            ?>
        </select>

        <label for="medico_id">Nombre del Medico:</label>
        <select id="medico_id" name="medico_id" required>
            <?php
            $queryMedicos = "SELECT medico_id, nombre FROM medicos";
            $resultMedicos = mysqli_query($con, $queryMedicos);
            if (mysqli_num_rows($resultMedicos) > 0) {
                while ($medico = mysqli_fetch_assoc($resultMedicos)) {
                    echo "<option value='" . htmlspecialchars($medico['medico_id']) . "'>" . htmlspecialchars($medico['nombre']) . "</option>";
                }
            } else {
                echo "<option value=''>No hay medicos disponibles</option>";
            }
            ?>
        </select>

        <label for="fecha">Fecha de la Consulta:</label>
        <input type="datetime-local" id="fecha" name="fecha" required min="<?php echo date('Y-m-d\TH:i'); ?>">

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required>

        <button type="submit" id="submitConsultaForm">Guardar/Actualizar</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/PFinal/Proyecto/public/js/consultas.js"></script>
</body>

</html>
