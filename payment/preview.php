<?php
session_start();
require("../database/db-setup.php");
require("../database/db-handle.php");
if (!isset($_SESSION["username"])) {
    header("Location: ../session/login.php");
}
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
    <div class="container">
    <div class="contenedor-central contenedor-flex row">
        <div class="contenedor-padre ">
            <div class="contenedor-hijo contenedor-flex row">
                    <div class="contenedor-izquierdo col-lg">
                        <h2 class="font-paytone">Resumen del pedido</h2>
                        <hr class="grow">
                        <p>Articulos a pagar:</p> <!-- Articulos capturado desde backend -->
                        <hr class="grow">
                        <div class="row">
                        <?php 
                            $username = "root"; 
                            $password = "ch1d0N83"; 
                            $dbname = "giftuwustore";
                            $servername = "mysql_db_php_2"; //docker-compose.yml database name
                            $port = 3306;  
                            $conn = new mysqli($servername, $username, $password, '', $port);
                         
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $conn->select_db($dbname); 

                            $user = $_SESSION["username"];
                            $tot_neto = $total_est = $descuento = 0;
                            $query = "SELECT * FROM cart WHERE user='$user'";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $itemid = $row["item"];
                                    $query = "SELECT * FROM item WHERE id='$itemid'";
                                    $itemres = $conn->query($query);
                                    if ($itemres->num_rows > 0) {
                                        while ($item = $itemres->fetch_assoc()) {
                                            $pricefinal= ($item['price'] - ($item['price'] * ($item['discount']/100)))*$row["quantity"];
                                            $tot_neto += $item['price']*$row["quantity"];
                                            $descuento +=$item['price'] * ($item['discount']/100);
                                            $total_est += $pricefinal;
                                            echo '<div class="contenedor-flex-vertical col-12 col-md-6">
                                            <p>'.$item["name"].'</p>
                                            <p>Cantidad: '.$row["quantity"].'</p>
                                            <img src="'.$item["image"].'" alt="" class="img-fluid img-thumbnail shadow p-3 mb-5 bg-body-tertiary rounded">                                           
                                            </div>';
                                        }
                                    }
                                }
                            }

                            $query = "SELECT * FROM purchase";
                            $result = $conn->query($query);
                            $folio = $result->num_rows + 1;
                            $couponDiscount = 0;
                            if (isset($_POST["cupon"])) {
                                $code = test_input($_POST["cupon"]);
                                $query = "SELECT * FROM coupon WHERE code='$code'";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $couponImage = $row["image"];
                                        $couponName = $row["name"];
                                        $couponDetails = $row["details"];
                                        $couponDiscount = $row["discount"];
                                    }
                                }
                            }
                            $conn->close();
                            switch ($_POST["pais"]) {
                                case 'ar':
                                    $taxes = 21;
                                    $total_taxes = $total_est + ($total_est * $taxes /100);
                                    $shipment = 5;
                                    $total_ship = $total_taxes + ($total_taxes * $shipment /100);
                                    $total = $total_ship - ($total_ship * $couponDiscount /100);
                                    break;
                                case 'eu':
                                    $taxes = 0;
                                    $total_taxes = $total_est + ($total_est * $taxes /100);
                                    $shipment = 5;
                                    $total_ship = $total_taxes + ($total_taxes * $shipment /100);
                                    $total = $total_ship - ($total_ship * $couponDiscount /100);
                                    break;
                                case 'br':
                                    $taxes = 18;
                                    $total_taxes = $total_est + ($total_est * $taxes /100);
                                    $shipment = 5;
                                    $total_ship = $total_taxes + ($total_taxes * $shipment /100);
                                    $total = $total_ship - ($total_ship * $couponDiscount /100);
                                    break;
                                case 'ch':
                                    $taxes = 19;
                                    $total_taxes = $total_est + ($total_est * $taxes /100);
                                    $shipment = 5;
                                    $total_ship = $total_taxes + ($total_taxes * $shipment /100);
                                    $total = $total_ship - ($total_ship * $couponDiscount /100);
                                    break;
                                case 'mx':
                                    $taxes = 16;
                                    $total_taxes = $total_est + ($total_est * $taxes /100);
                                    $shipment = 0;
                                    $total_ship = $total_taxes + ($total_taxes * $shipment /100);
                                    $total = $total_ship - ($total_ship * $couponDiscount /100);
                                    break;
                                default:
                                    $taxes = 16;
                                    $total_taxes = $total_est + ($total_est * $taxes /100);
                                    $shipment = 5;
                                    $total_ship = $total_taxes + ($total_taxes * $shipment /100);
                                    $total = $total_ship - ($total_ship * $couponDiscount /100);
                                    break;
                            }
                        ?>
                        </div>
                    </div>
                    <div class=" col-lg">
                        <div class="contenedor-derecho col-lg">
                            <h2 class="font-paytone">Detalles de la compra</h2>
                            <p>
                            <?php
                            date_default_timezone_set('America/Mexico_City'); // Configura la zona horaria (por ejemplo, Nueva York)
                            $fecha_actual = date("l, d F Y"); // Formato: día de la semana, día de mes de año
                            echo "Fecha de emisión del cobro: <h3>" . $fecha_actual."</h3>";
                            echo "Folio: $folio";
                            ?>
                            </p>
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-truck"></i> Cupón utilizado:</p><!-- Envio capturado desde backend -->
                        <?php
                        if (isset($couponImage)) {
                            echo '<img class="img-fluid p-4 img-thumbnail" src="'.$couponImage.'" alt="">';
                            echo '<p>'.$couponName.'</p>';
                            echo '<p>'.$couponDetails.'</p>';
                        } else {
                            echo '<p>No se ingresó un cupón válido.</p>';
                        }
                        ?>
                        <p>Descuento en Cupón: $<?php echo $total_ship * $couponDiscount /100; ?></p>
                        <hr class="grow"><br>
                        <p>Total sin deducciones: $<?php echo $total_est; ?></p>
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-percent"></i> Impuestos: $<?php echo $total_est * $taxes / 100 ?></p>
                        <p>Total con impuestos: $<?php echo $total_taxes; ?></p>
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-truck"></i> Envio: $<?php echo $total_taxes * $shipment / 100 ?></p>
                        <p>Total con envio: $<?php echo $total_ship; ?></p>
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-handshake"></i> Metodo de pago: <?php echo test_input($_POST["metodo_pago"]) ?></p>
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-house-user"></i> Direccion donde se enviara: <?php echo test_input($_POST["domicilio"]).", ".test_input($_POST["ciudad"]);?></p>
                        <hr class="grow"><br>
                        <p><i class="fa-solid fa-money-bill"></i> Total a pagar: $<?php echo $total; ?></p>
                        
                        <div class="d-grid gap-2">
                            <form action="./thank-you.php" method="post">
                                <input type="hidden" name="domicilio" value="<?php echo test_input($_POST["domicilio"]).", ".test_input($_POST["ciudad"]) ?>">
                                <input type="hidden" name="pago" value="<?php echo test_input($_POST["metodo_pago"]) ?>">
                                <input type="hidden" name="total" value="<?php echo $total; ?>">
                                <input type="hidden" name="coupondis" value="<?php echo $total_ship * $couponDiscount /100; ?>">
                                <input type="hidden" name="totalest" value="<?php echo $total_est; ?>">
                                <input type="hidden" name="taxes" value="<?php echo $total_est * $taxes / 100 ?>">
                                <input type="hidden" name="totaltaxes" value="<?php echo $total_taxes; ?>">
                                <input type="hidden" name="shipment" value="<?php echo $total_taxes * $shipment / 100 ?>">
                                <input type="hidden" name="totalship" value="<?php echo $total_ship; ?>">
                                <input type="hidden" name="name" value="<?php echo test_input($_POST["nombre"]); ?>">
                                <input type="hidden" name="mail" value="<?php echo test_input($_POST["mail"]); ?>">
                                <button class="btn btn-primary" target="_blank" type="submit" name="submit">PAGAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
        include("../footer/footer.php");
    ?>
</body>
</html>
<script src="https://kit.fontawesome.com/b61e18d0de.js" crossorigin="anonymous"></script>