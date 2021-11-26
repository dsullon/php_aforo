<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php
    include_once("includes/css_link.php");
    ?>
    <title>Reporte</title>
</head>

<body>
    <?php
    include_once("includes/navbar.inc.php")
    ?>

    <div class="main">
        <div class="container">
            <form class="row g-3">
                <div class="col-auto form-floating mb-3">
                    <input type="date" class="form-control buscar" id="fecha">
                    <label for="fecha">Fecha</label>
                </div>

                <div class="col-auto form-floating mb-3">
                    <select class="form-control buscar" id="edificio">
                        <option value="-1">--Seleccione--</option>
                    </select>
                    <label for="edificio">Edificio</label>
                </div>
            </form>
            <hr>
            <div class="row row-cols-1 row-cols-md-4 g-4" id="ambientes">
            </div>
        </div>
    </div>

    <?php
    include_once("includes/js_link.php");
    ?>
    <script>
        $(document).ready(function() {
            cargarEdificios();
        })

        $(".buscar").on("change", function() {

            const fecha = $("#fecha").val();
            const edificio = $("#edificio").val();
            if (fecha != "" && edificio > -1) {
                $("#ambientes").children().remove();
                $.post("data/reserva.php", {
                    "accion": "consultar",
                    fecha,
                    edificio
                }).then(function(response) {
                    const data = JSON.parse(response);
                    for (let index = 0; index < data.length; index++) {
                        const ambiente = data[index];
                        const tarjeta = crearTarjeta(ambiente);
                        $("#ambientes").append(tarjeta);
                        
                    }
                })
            }
        })

        function cargarEdificios() {
            $.get("data/edificio.php?accion=listar").then(function(response) {
                if (response != "NoData") {
                    const data = JSON.parse(response);
                    for (let index = 0; index < data.length; index++) {
                        const edificio = data[index];
                        $("#edificio").append('<option value=' + edificio.id + '>' + edificio.nombre + '</option>');
                    }
                }
            })
        }

        function crearTarjeta(ambiente){
            const columna = document.createElement('div');
            columna.className = "col";

            const card = document.createElement('div');
            card.className = "card h-100";

            const cardBody = document.createElement('div');
            cardBody.className = "card-body";

            const titulo = document.createElement('h5');
            titulo.className = "card-title";
            titulo.innerText = ambiente.nombre;

            const texto = document.createElement('p');
            texto.className = "card-text";
            texto.innerText = ambiente.reservas + " / " + ambiente.aforo;

            cardBody.appendChild(titulo);
            cardBody.appendChild(texto);
            card.appendChild(cardBody);
            columna.appendChild(card);

            return columna;
        }
    </script>


</body>

</html>