<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php
    include_once("includes/css_link.php");
    ?>

    <title>Mis reservas</title>
</head>

<body>
    <?php
    include_once("includes/navbar.inc.php")
    ?>
    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <th>Edificio</th>
                    <th>Ambiente</th>
                    <th>Fecha</th>
                </thead>
                <tbody id="tblDatos">

                </tbody>
            </table>
        </div>
    </main>

    <?php
    include_once("includes/js_link.php");
    ?>

    <script>
        $(document).ready(function() {
            cargarReservas();
        })

        function cargarReservas() {
            $.get("data/reserva.php?accion=reserva_usuario").then(function(response) {
                const data = JSON.parse(response);
                let html = "";
                for (let idx = 0; idx < data.length; idx++) {
                    const reserva = data[idx];
                    html+="<tr>";
                    html+="<td>"+reserva.edificio+"</td>";
                    html+="<td>"+reserva.ambiente+"</td>";
                    html+="<td>"+reserva.fecha+"</td>";
                    html+="</tr>";
                }
                $("#tblDatos").html(html);
            })
        }
    </script>
</body>

</html>