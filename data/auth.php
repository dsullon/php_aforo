<?php
    session_start();
    require_once("db.php");
    if ($_POST) {
        if ($_POST['accion'] == "login") {
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $sql = "SELECT id, nombres, apellidos, username
                    FROM usuarios
                    WHERE username='$usuario' 
                        AND password = '$password'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $_SESSION['usuario'] = $user;
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + 7200;
                echo json_encode($user);
            } else{
                echo "NoData";
            }
        }
    }
