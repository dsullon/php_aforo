<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once("includes/css_link.php")
    ?>
    <link href="assets/css/login.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class="text-center">
    <main class="form-signin">
        <form>
            <img class="mb-4" src="assets/img/login-icon.png" alt="" width="72" height="57">

            <div class="form-floating">
                <input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario">
                <label for="usuario">usuario</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Contraseña">
                <label for="password">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="button" id="btnLogin">Iniciar sesión</button>
            <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
        </form>
    </main>
    <?php
    include_once("includes/js_link.php");
    ?>
    <script>
        $(document).ready(function() {
            $("#btnLogin").click(function() {
                const usuario = $("#usuario").val();
                const password = $("#password").val();
                if (usuario == "" || password == "") {
                    Swal.fire({
                        title: 'Error!',
                        text: 'No se ingresaron los datos correctamente',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                    return;
                }
                Swal.showLoading();

                $.post("data/auth.php", {
                    "accion": "login",
                    usuario,
                    password
                }).then(function(response) {
                    if (response == "NoData") {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Usuario/Contraseña incorrecta',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    } else {
                        window.location = "index.php";
                    }
                })
            })
        })
    </script>
</body>

</html>