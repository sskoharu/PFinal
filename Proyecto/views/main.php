<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clínica</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .jumbotron {
            background-color: #f8f9fa;
            border-radius: 0.3rem;
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 0.3rem;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }

        .lead {
            font-size: 1.25rem;
        }

        @media (max-width: 576px) {
            .d-flex {
                flex-direction: column;
            }

            .d-flex a {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="jumbotron mt-4">
        <h1 class="display-4">Bienvenido a la Gestión de Clínica</h1>
        <p class="lead">Seleccione una de las siguientes opciones para comenzar a gestionar su clínica.</p>
        <hr class="my-4">
        <div class="d-flex justify-content-around">
            <a class="btn btn-custom" href="index.php?controller=paciente&action=list" role="button">Gestionar Pacientes</a>
            <a class="btn btn-custom" href="index.php?controller=medico&action=list" role="button">Gestionar Médicos</a>
            <a class="btn btn-custom" href="index.php?controller=consulta&action=list" role="button">Gestionar Consultas</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
