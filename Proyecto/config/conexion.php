<?php
class Clase_Conectar {
    public function Procedimiento_Conectar() {
        $con = new mysqli("localhost", "root", "", "clinicadb");
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        return $con;
    }
}
?>
