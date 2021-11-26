<?php
require_once("db.php");
if ($_POST) {
} else {
    if ($_GET['accion'] == "listarPorEdificio") {
        $edificio = $_GET['id'];
        $ambientes = array();
        $sql = "SELECT id, nombre, aforo
                FROM ambientes
                WHERE edificio_id = $edificio";
        $result = $db->query($sql);
        while ($ambiente = $result->fetch_assoc()) {
            $ambientes[] = $ambiente;
        }
        if (count($ambientes) > 0) {
            echo json_encode($ambientes);
        } else {
            echo "NoData";
        }
        
    }
}
