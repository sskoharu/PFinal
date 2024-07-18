<?php
require_once('../config/conexion.php');
require_once('../models/medico.model.php');
$medico = new Clase_Medico();

header('Content-Type: application/json');  // Asegúrate de que la respuesta sea JSON

$op = isset($_GET['op']) ? $_GET['op'] : '';

switch ($op) {
    case "uno":
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->id) && is_numeric($data->id)) {
            $id = intval($data->id); // Asegurarse de que $id es un entero
            $datos = $medico->uno($id);
            $medicoData = mysqli_fetch_assoc($datos);
            if ($medicoData) {
                echo json_encode($medicoData);
            } else {
                echo json_encode(["success" => false, "message" => "Médico no encontrado"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "ID inválido"]);
        }
        break;
        
    case "insertar":
    case "actualizar":
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data["nombre"], $data["especialidad"], $data["telefono"], $data["email"])) {
            $nombre = trim($data["nombre"]);
            $especialidad = trim($data["especialidad"]);
            $telefono = trim($data["telefono"]);
            $email = trim($data["email"]);
            
            if (empty($nombre) || empty($especialidad)) {
                echo json_encode(["success" => false, "message" => "Nombre y especialidad son obligatorios"]);
                break;
            }

            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $result = $medico->actualizar($id, $nombre, $especialidad, $telefono, $email);
            } else {
                $result = $medico->insertar($nombre, $especialidad, $telefono, $email);
            }
            
            echo json_encode(["success" => $result == "ok"]);
        } else {
            echo json_encode(["success" => false, "message" => "Faltan datos"]);
        }
        break;
        
    case "eliminar":
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = intval($_GET['id']);
            $result = $medico->eliminar($id);
            echo json_encode(["success" => $result == "ok"]);
        } else {
            echo json_encode(["success" => false, "message" => "ID inválido"]);
        }
        break;
        
    default:
        echo json_encode(["success" => false, "message" => "Operación no válida"]);
        break;
}
?>
