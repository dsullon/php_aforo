<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:login.php");
    exit();
} else {
    $currentTime = time();
    if ($currentTime > $_SESSION['expire']) {
        session_unset();
        session_destroy();
        header("location:login.php");
    }
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reporte.php">Consultas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reservas.php">Mis reservas</a>
                </li>
            </ul>

        </div>
        <div class="d-flex">
            <a class="btn btn-outline-success" href="data/logout.php">Salir</a>
        </div>
    </div>
</nav>