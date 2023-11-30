<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <style>
.contenedor-central {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
}

.contenedor-padre {
    border: 5px solid transparent;
    background: linear-gradient(45deg, #ff9900, #ff66cc);
    box-sizing: border-box; /* Incluye padding y borde en el tamaño total del elemento */
}

.contenedor-hijo {
    background-color: #ededed;
    padding: 20px; /* Espaciado interno */
}

.contenedor-izquierdo {
    flex: 1;
    background-color: #ffffff;
    padding: 20px;
}

.contenedor-derecho {
    flex: 1;
    background-color: #f5f5f5;
    padding: 20px;
}

.inputs {
    border: 1px solid #4d82bc;
    outline: none;
    border-radius: 10px;
}
    </style>
    
    <title>Pagando articulos</title>
</head>
<body>
    <div class="contenedor-central contenedor-flex row">
        <div class="contenedor-padre ">
            <div class="contenedor-hijo contenedor-flex row">
                    <div class="contenedor-izquierdo col-lg">
                        <h2>Resumen del pedido</h2>
                        <hr class="grow">
                        <p>Articulos a pagar:</p> <!-- Articulos capturado desde backend -->
                        <hr class="grow">
                            <div class="contenedor-flex-vertical">
                                <img src="755478.jpg" alt="" class="img-fluid img-thumbnail shadow p-3 mb-5 bg-body-tertiary rounded">
                                <p>Articulo de ejemplo</p>
                            </div>
                    </div>
                    <div class=" col-lg">
                        <div class="contenedor-derecho col-lg">
                            <h2>Detalles de la compra</h2>
                            <p><?php

                             //la fecha y folio deben ir en backend

                            date_default_timezone_set('America/Mexico_City'); // Configura la zona horaria (por ejemplo, Nueva York)
                            $fecha_actual = date("l, d F Y"); // Formato: día de la semana, día de mes de año
                            echo "Fecha de emisión del cobro: <h3>" . $fecha_actual."</h3>";
                            $numero_aleatorio = mt_rand(1000000000, 9999999999);
                            echo "Folio: $numero_aleatorio";
                            ?>
                            </p>
                        <hr class="grow"><br>
                        <label for="cupon"><i class="fa-solid fa-ticket"></i> Ingresa tu código de cupón:</label><br><br>
                        <input type="text" id="cupon" name="cupon" placeholder="Escribe tu código aquí" class="inputs">
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-truck"></i> Envio:</p><!-- Envio capturado desde backend -->
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-percent"></i> Impuestos:</p>
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-handshake"></i> Metodo de pago:</p>
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-house-user"></i> Direccion donde se enviara:</p>
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-money-bill"></i> Total a pagar: </p><!-- Total capturado desde backend -->
                        
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="button">PAGAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://kit.fontawesome.com/b61e18d0de.js" crossorigin="anonymous"></script>