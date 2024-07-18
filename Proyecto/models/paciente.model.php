<?php
require_once(__DIR__ . '/../config/conexion.php');

class Clase_Paciente {
    private $con;

    public function __construct() {
        $this->con = (new Clase_Conectar())->Procedimiento_Conectar();
    }

    public function probar() {
        return $this->con->error;
    }

    public function todos() {
        $cadena = "SELECT * FROM pacientes";
        $resultado = mysqli_query($this->con, $cadena);
        return $resultado;
    }

    public function uno($id) {
        $cadena = "SELECT * FROM pacientes WHERE paciente_id = $id";
        $resultado = mysqli_query($this->con, $cadena);
        return $resultado;
    }

    public function insertar($nombre, $apellido, $direccion, $telefono) {
        $cadena = "INSERT INTO `pacientes`(`nombre`, `apellido`, `direccion`, `telefono` ) VALUES ('$nombre','$apellido','$direccion','$telefono')";
        if (mysqli_query($this->con, $cadena)) {
            return "ok";
        } else {
            return $this->con->error;
        }
    }

    public function actualizar($id, $nombre, $apellido, $direccion, $telefono) {
        $cadena = "UPDATE `pacientes` SET `nombre`='$nombre',`apellido`='$apellido',`direccion`='$direccion',`telefono`='$telefono' WHERE `paciente_id`=$id";
        if (mysqli_query($this->con, $cadena)) {
            return "ok";
        } else {
            return $this->con->error;
        }
    }

    public function eliminar($id) {
        try {
            $con = new Clase_Conectar();
            $con = $con->Procedimiento_Conectar();
            $cadena = "DELETE FROM pacientes WHERE paciente_id = $id";
            if (mysqli_query($con, $cadena)) {
                return "ok";
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
                return "No se puede eliminar el paciente porque tiene citas asociadas.";
            }
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }
    

    public function buscarXNombre($nombre) {
        $cadena = "SELECT * FROM pacientes WHERE nombre = '$nombre'";
        $resultado = mysqli_query($this->con, $cadena);
        return $resultado;
    }
}
?>
