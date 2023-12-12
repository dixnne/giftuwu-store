<?php
    session_start();
    require("../database/db-setup.php");
    require("../database/db-handle.php");
?>
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
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style-pay.css">
    <style>
    </style>
    <title>Gift uwu Store</title>
</head>
<body id="bootstrap-override" class="bg-color">
<?php
    if (isset($_SESSION["username"])) {
        include("../header/header-login.php");
    }else{
        include("../header/header.html");
    }
?>
<section class="py-3">
    <form action="preview.php" method="post">
        <div class="container">
            <div class="contenedor-central contenedor-flex row">
                <div class="contenedor-padre ">
                    <div class="contenedor-hijo contenedor-flex row">
                        <div class="contenedor-izquierdo col-lg">
                        <h2 class="font-paytone">Completa el formulario</h2>
                        <hr class="grow">
                        
                            <label for="nom"><i class="fa-solid fa-user"></i> Nombre completo</label><br><br>
                            <input type="text" id="nom" name="nombre" placeholder="Escribe tu nombre aqui" class="inputs form-control" ><br><br>
                            <label for="correo"><i class="fa-solid fa-envelope"></i> Correo electronico</label><br><br>
                            <input type="email" id="correo" name="mail" placeholder="Escribe tu correo aqui" class="inputs form-control" ><br><br>
                            <label for="domicilio"><i class="fa-solid fa-house-user"></i> Domicilio</label><br><br>
                            <input type="text" id="domicilio" name="domicilio" placeholder="Escribe tu domicilio aqui" class="inputs form-control" ><br><br>
                            <label for="ciudad"><i class="fa-solid fa-city"></i> Ciudad</label><br><br>
                            <input type="text" id="ciudad" name="ciudad" placeholder="Escribe tu ciudad aqui" class="inputs form-control" ><br><br>
                            <label for=""><i class="fa-solid fa-globe"></i> Pais</label>
                            <select name="pais" id="pais" class="inputs form-select" >
                                <option value="ar" class="inputs">Argentina</option>
                                <option value="br" class="inputs">Brasil</option>
                                <option value="ch" class="inputs">Chile</option>
                                <option value="eu" class="inputs">Estados Unidos</option>
                                <option value="mx" class="inputs">Mexico</option>
                            </select><br><br>
                            <label for="cp"><i class="fa-solid fa-inbox"></i> Codigo postal</label><br><br>
                            <input type="number" id="cp" name="cp" placeholder="Escribe tu codigo postal aquí" class="inputs form-control" ><br><br>
                            <label for="num"><i class="fa-solid fa-phone"></i> Numero de telefono</label><br><br>
                            <input type="number" id="num" name="num_tel" placeholder="Escribe tu numero telefonico aquí" class="inputs form-control" ><br><br>
                        </div>
                    <div class=" col-lg">
                        <div class="contenedor-derecho col-lg">
                            <h2 class="font-paytone">¿Cómo deseas pagar?</h2>
                            <hr class="grow"><br>
                            <label for="cupon"><i class="fa-solid fa-ticket"></i> Ingresa tu código de cupón:</label><br><br>
                            <input type="text" id="cupon" name="cupon" placeholder="Escribe tu código aquí" class="inputs form-control">
                            <hr class="grow">
                            <div class="pay-card">
                                <input type="radio" id="visa" name="metodo_pago" value="VISA">
                                <i class="fa-brands fa-cc-visa fa-xl"></i>
                                <label for="visa"> VISA</label>
                            </div>
                            <br>
                            <div class="pay-card">
                                <input type="radio" id="mastercard" name="metodo_pago" value="MASTERCARD">
                                <i class="fa-brands fa-cc-mastercard fa-xl"></i>
                                <label for="mastercard"> MASTERCARD</label>
                            </div>
                            <br>
                            <div class="pay-card">
                                <input type="radio" id="oxxo" name="metodo_pago" value="Pago en OXXO">
                                <i class="fa-solid fa-shop fa-lg"></i>
                                <label for="oxxo"> Pago en OXXO</label>
                            </div>
                            <br>
                            <div id="show-visa" class="pay-card mb-3" style="display:none;">
                                <label for="card_num"><i class="fa-solid fa-credit-card fa-lg"></i> Numero de tarjeta</label>
                                <input type="number" id="card_num" name="card_num" placeholder="Escribe tu numero de tarjeta sin espacios aqui" class="inputs form-control" ><br>
                                <label for="card_exp"><i class="fa-solid fa-calendar fa-lg"></i> Fecha de expiracion</label><br>
                                <input type="number" id="card_exp" name="card_exp" placeholder="Mes" class="inputs form-control" ><br>
                                <input type="number" id="card_exp" name="card_exp" placeholder="Año" class="inputs form-control" ><br>
                                <label for="card_security"><i class="fa-regular fa-credit-card fa-lg"></i> Codigo de seguridad</label>
                                <input type="number" id="card_security" name="card_security" placeholder="CVV" class="inputs form-control" >
                            </div>
                            <div id="show-oxxo" class="pay-card mb-3 text-center" style="display:none;">
                            <i class="fa-solid fa-money-check-dollar fa-xl" style="color: #1bb11d;"></i><br>
                            <label>Deposite a la siguiente cuenta en una sucursal de OXXO.</label>
                            <?php
                                $cuenta = mt_rand(400000000000000000, 999999999999999999);
                                echo "No. de cuenta: $cuenta";
                            ?>
                            </div>
                        </div>
                    </div>
                        <div class="d-grid gap-2 space" >
                            <button class="btn btn-primary" name="submit" type="submit">CONFIRMAR Y CONTINUAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<?php
    include("../footer/footer.php");
?>
</body>
</html>
<script src="https://kit.fontawesome.com/b61e18d0de.js" crossorigin="anonymous"></script>
<script src="methods.js"></script>