<?php
require_once("db.php");
if ($_POST) {
} else {
    if ($_GET['accion'] == 'listar') {
        $edificios = array();
        $sql = "SELECT id, nombre, direccion, aforo
                FROM edificios";
        $result = $db->query($sql);
        while ($edificio = $result->fetch_assoc()) {
            $edificios[] = $edificio;
        }

        if (count($edificios) > 0) {
            echo json_encode($edificios);
        } else {
            echo "NoData";
        }
    } elseif ($_GET['accion'] == 'obtener') {
        $id = $_GET['id'];
        $sql = "SELECT id, nombre, direccion, aforo
                FROM edificios
                WHERE id = $id";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo "NoData";
        }
        
    }
}
