<?php
session_start();
require_once("db.php");
$user = $_SESSION['usuario'];
$userId = $user['id'];

if ($_POST) {
    if ($_POST['accion'] == "registrar") {
        $fecha = $_POST['fecha'];
        $ambiente = $_POST['ambiente'];
        $sql = "INSERT INTO reservas(fecha, ambiente_id, usuario_id)
                    VALUES('$fecha', $ambiente, $userId)";

        $result = $db->query($sql);
        if ($result > 0) {
            echo "exito";
        } else {
            echo "error";
        }
    } elseif ($_POST['accion'] == "consultar") {
        $fecha = $_POST['fecha'];
        $edificio = $_POST['edificio'];
        $sql = "SELECT A.id, A.nombre, A.aforo, COUNT(B.id) AS reservas
                FROM `ambientes` A LEFT JOIN reservas B
                ON A.id = B.ambiente_id
                AND B.fecha='$fecha'
                WHERE A.edificio_id = $edificio
                GROUP BY nombre";
        $result = $db->query($sql);
        $ambientes = array();
        if ($result->num_rows > 0) {
            while ($ambiente = $result->fetch_assoc()) {
                $ambientes[] = $ambiente;
            }
        }
        echo json_encode($ambientes);
    }
} else {
    if ($_GET['accion'] == "reserva_usuario") {
        $sql = "SELECT C.nombre AS edificio, B.nombre AS ambiente, A.fecha 
                    FROM `reservas` A INNER JOIN ambientes B
                    ON ambiente_id=B.id INNER JOIN edificios C
                    ON B.edificio_id=C.id
                    WHERE A.usuario_id=$userId";
        $result = $db->query($sql);
        $reservas = array();
        if ($result->num_rows > 0) {
            while ($reserva = $result->fetch_assoc()) {
                $reservas[] = $reserva;
            }
        }
        echo json_encode($reservas);
    } elseif ($_GET['accion'] == "verificar_fecha") {
        $existe = "NoData";
        $fecha = $_GET['fecha'];
        $sql = "SELECT id, fecha
                FROM `reservas`
                WHERE fecha='$fecha' AND usuario_id=$userId";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $existe = "Existe";
        }
        echo $existe;
    } elseif ($_GET['accion'] == "verificar_aforo") {
        $fecha = $_GET['fecha'];
        $ambiente = $_GET['ambiente'];
        $sql = "SELECT nombre, aforo, COUNT(B.id) AS reservas, 
                    aforo - COUNT(B.id) AS disponible
                FROM ambientes A LEFT JOIN reservas B
                ON A.id = B.ambiente_id 
                    AND B.fecha='$fecha'
                WHERE A.id=$ambiente
                GROUP BY nombre";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo "NoData";
        }
    }
}
