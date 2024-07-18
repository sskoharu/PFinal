<?php
require_once('../config/conexion.php');
require_once('../models/consulta.model.php');
$consulta = new Clase_Consulta();

header('Content-Type: application/json'); 

switch ($_GET['op']) {
    case "uno":
        $id = json_decode(file_get_contents("php://input"))->id;
        $datos = $consulta->uno($id);
        $consultaData = mysqli_fetch_assoc($datos);
        if ($consultaData) {
            echo json_encode($consultaData);
        } else {
            echo json_encode(["success" => false, "message" => "Consulta no encontrada"]);
        }
        break;
    case "insertar":
        $data = json_decode(file_get_contents("php://input"), true);
        $paciente_id = $data["paciente_id"];
        $medico_id = $data["medico_id"];
        $fecha = $data["fecha"];
        $descripcion = $data["descripcion"];
        $result = $consulta->insertar($paciente_id, $medico_id, $fecha, $descripcion);
        if ($result == "ocupada") {
            echo json_encode(["success" => false, "message" => "La fecha y hora seleccionadas ya están ocupadas."]);
        } elseif ($result == "ok") {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al guardar la consulta"]);
        }
        break;
    case "actualizar":
        $id = $_GET['id'];
        $data = json_decode(file_get_contents("php://input"), true);
        $medico_id = $data["medico_id"];
        $fecha = $data["fecha"];
        $descripcion = $data["descripcion"];
        $result = $consulta->actualizar($id, $medico_id, $fecha, $descripcion);
        echo json_encode(["success" => $result == "ok"]);
        break;
    case "eliminar":
        $id = $_GET['id'];
        $result = $consulta->eliminar($id);
        echo json_encode(["success" => $result == "ok"]);
        break;
    default:
        echo json_encode(["success" => false, "message" => "Operación no válida"]);
        break;
}
?>
