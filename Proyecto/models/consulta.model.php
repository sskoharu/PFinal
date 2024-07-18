<?php
require_once('../config/conexion.php');

class Clase_Consulta
{
    public function todos()
    {
        try {
            $con = new Clase_Conectar();
            $con = $con->Procedimiento_Conectar();
            $cadena = "SELECT * FROM consultas";
            $resultado = mysqli_query($con, $cadena);
            $con->close();
            return $resultado;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function uno($id)
    {
        try {
            $con = new Clase_Conectar();
            $con = $con->Procedimiento_Conectar();
            $cadena = "SELECT * FROM consultas WHERE consulta_id = $id";
            $resultado = mysqli_query($con, $cadena);
            return $resultado;
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }

    //función para verificar si la fecha está ocupada
    public function verificarFecha($fecha)
    {
        try {
            $con = new Clase_Conectar();
            $con = $con->Procedimiento_Conectar();
            $cadena = "SELECT * FROM consultas WHERE fecha = '$fecha'";
            $resultado = mysqli_query($con, $cadena);
            $con->close();
            return mysqli_num_rows($resultado) > 0;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insertar($paciente_id, $medico_id, $fecha, $descripcion)
    {
        try {
            $con = new Clase_Conectar();
            $con = $con->Procedimiento_Conectar();

            // Verificar si la fecha ya está ocupada
            if ($this->verificarFecha($fecha)) {
                return "ocupada";
            }

            $cadena = "INSERT INTO `consultas`(`paciente_id`, `medico_id`, `fecha`, `descripcion`) VALUES ($paciente_id, $medico_id, '$fecha', '$descripcion')";
            if (mysqli_query($con, $cadena)) {
                return "ok";
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($id, $medico_id, $fecha, $descripcion)
    {
        try {
            $con = new Clase_Conectar();
            $con = $con->Procedimiento_Conectar();


            $cadena = "UPDATE `consultas` SET `medico_id`=$medico_id,`fecha`='$fecha',`descripcion`='$descripcion' WHERE `consulta_id`=$id";
            if (mysqli_query($con, $cadena)) {
                return "ok";
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($id)
    {
        try {
            $con = new Clase_Conectar();
            $con = $con->Procedimiento_Conectar();
            $cadena = "DELETE FROM consultas WHERE consulta_id = $id";
            if (mysqli_query($con, $cadena)) {
                return "ok";
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }
}
