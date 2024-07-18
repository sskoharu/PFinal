<?php
$controller = $_GET['controller'] ?? 'main';
$action = $_GET['action'] ?? 'list';

try {
    switch ($controller) {
        case 'paciente':
            require_once('paciente/' . $action . '.php');
            break;
        case 'consulta':
            require_once('consulta/' . $action . '.php');
            break;
        case 'medico':
            require_once('medico/' . $action . '.php');
            break;
        default:
            require_once('main.php');
            break;
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
