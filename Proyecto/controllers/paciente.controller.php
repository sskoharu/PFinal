<?php
require_once('../config/conexion.php');
require_once('../models/paciente.model.php');
$paciente = new Clase_Paciente();

header('Content-Type: application/json');  // Asegúrate de que la respuesta sea JSON

switch ($_GET['op']) {
    case "uno":
        $id = json_decode(file_get_contents("php://input"))->id;
        $datos = $paciente->uno($id);
        $pacienteData = mysqli_fetch_assoc($datos);
        if ($pacienteData) {
            echo json_encode($pacienteData);
        } else {
            echo json_encode(["success" => false, "message" => "Paciente no encontrado"]);
        }
        break;
    case "insertar":
        $data = json_decode(file_get_contents("php://input"), true);
        $nombre = $data["nombre"];
        $apellido = $data["apellido"];
        $direccion = $data["direccion"];
        $telefono = $data["telefono"];
        $result = $paciente->insertar($nombre, $apellido, $direccion, $telefono);
        echo json_encode(["success" => $result == "ok"]);
        break;
    case "actualizar":
        $id = $_GET['id'];
        $data = json_decode(file_get_contents("php://input"), true);
        $nombre = $data["nombre"];
        $apellido = $data["apellido"];
        $direccion = $data["direccion"];
        $telefono = $data["telefono"];
        $result = $paciente->actualizar($id, $nombre, $apellido, $direccion, $telefono);
        echo json_encode(["success" => $result == "ok"]);
        break;
    case "eliminar":
        $id = $_GET['id'];
        $result = $paciente->eliminar($id);
        echo json_encode(["success" => $result == "ok"]);
        break;
    default:
        echo json_encode(["success" => false, "message" => "Operación no válida"]);
        break;
}
?>
