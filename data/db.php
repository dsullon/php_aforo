<?php
@$db = new mysqli("localhost", "root", "123456", "iestfa_aforo");

if ($db->connect_errno) {
    echo "Error al conectar la base de datos";
    exit();
}