<?php
session_start();
require("../database/db-setup.php");
require("../database/db-handle.php");
if (!isset($_SESSION["username"]) || $_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["submit"])) {
    header("Location: ../session/login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gift uwu Store</title>
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/style-pay.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require '../PHPMailer-master/src/Exception.php';
        require '../PHPMailer-master/src/PHPMailer.php';
        require '../PHPMailer-master/src/SMTP.php';

        $mail = new PHPMailer();
            $body = '<!DOCTYPE html>
            <html>
            <head>
                <title>Thank You!</title>
                <style>
                    body{
                        font-family: Verdana, Geneva, Tahoma, sans-serif;
                    }
                    header{
                        padding: 5rem;
                        background-color:black;
                        color:white;
                        text-align:center;
                    }
                    .contenedor-padre {
                        border: 5px solid transparent;
                        background: linear-gradient(80deg, #836096,#ed7b7b,#f0b86e,#212529);
                        box-sizing: border-box; /* Incluye padding y borde en el tamaño total del elemento */
                    }
                    .contenedor-central {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 30px;
                    }
                    .contenedor-hijo {
                        background-color: #eeeeee;
                        padding: 20px; /* Espaciado interno */
                    }
                    .color-destino{
                        background-color:#836096;
                        color:white;
                    }
                    .sombra{
                        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.9);
                    }
                    .espacio{
                        padding:5 rem;
                    }
                    .text-center{
                        text-align:center;
                    }
                    .color-card{
                        background-color:#f8f9fa;
                    }
                    .font-size{
                        font-size:20px;
                    }
                    .fst-italic{
                        font-size:italic;
                    }
                    .font-size-peq{
                        font-size:10px;
                    }
                    .text-start{
                        text-align:left;
                    }
                </style>
            </head>
            <body>
            <div class="contenedor-central">
            <div class="contenedor-padre">
                <div class="contenedor-hijo">
                    <header><h1>GRACIAS POR TU COMPRA</h1></header>
                    <div class="color-destino sombra espacio">
                        <h1 class="text-center">
                        Se ha realizado tu pedido, disfrútalo!
                        </h1>
                    </div>
                    <hr class="grow"
                    <h2 class="font-paytone">Resumen del pedido</h2>
                    <hr class="grow">
                    <p>Artículos enviados:</p><ul>';

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
                    $items = 0;
                    $query = "SELECT * FROM cart WHERE user='$user'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $itemid = $row["item"];
                            $query = "SELECT * FROM item WHERE id='$itemid'";
                            $itemres = $conn->query($query);
                            if ($itemres->num_rows > 0) {
                                while ($item = $itemres->fetch_assoc()) {
                                    $body.= '<li>'.$item["name"].'</li>';
                                    $items++;
                                }
                            }
                        }
                    }
                    $conn->close();

                    $body.= '</ul>
                    <p>Descuento en Cupón: $'.test_input($_POST["coupondis"]).'</p>
                    <hr class="grow"><br>
                    <p>Total sin deducciones: $'.test_input($_POST["totalest"]).'</p>
                    <hr class="grow"><br>
                    <p>Impuestos: $'.test_input($_POST["taxes"]).'</p>
                    <p>Total con impuestos: $'.test_input($_POST["totaltaxes"]).'</p>
                    <hr class="grow"><br>
                    <p>Envio: $'.test_input($_POST["shipment"]).'</p>
                    <p>Total con envio: $'.test_input($_POST["totalship"]).'</p>
                    <hr class="grow"><br>
                    <p><i class="fa-solid fa-handshake"></i> Metodo de pago: '.test_input($_POST["pago"]).'</p>
                    <hr class="grow"><br>
                    <p><i class="fa-solid fa-money-bill"></i> Total a pagar: $<'.test_input($_POST["total"]).'</p>
                    <hr class="grow">
                    <div class="sombra espacio color-card font-size">
                        <p>Haremos entrega en '.test_input($_POST["domicilio"]).'</p>
                        <p>A nombre de: '.test_input($_POST["name"]).'</p>
                        <hr>
                        <p>Devolver siempre es gratis, si el producto que recibiste no te agradó cuentas con <strong>30 dias para realizar la devolución.</strong></p><br>
                        <p class="text-center">¡gracias por tu preferencia! uwu</p>
                        <p class="fst-italic font-size-peq text-start">Atte: El equipo de <strong>GIFT UWU STORE</strong></p>
                    </div>
                </div>
            </div>
       </div>
        </body>
        </html>';
         $mail->isSMTP();
         $mail->SMTPDebug = 0;
         $mail->Debugoutput = 'html';
         $mail->Host = 'smtp.gmail.com';
         $mail->SMTPAuth = true;
         $mail->SMTPSecure= 'tls';
         $mail->Port = 587;
         $mail->Username = 'wearedevs.psw@gmail.com';
         $mail->Password = 'vlgm xuqz wckq affp';
         $mail->From = 'wearedevs.psw@gmail.com';
         $mail->FromName = "Gift uwu Store";
         $mail->addAddress(test_input($_POST["mail"]));
         
         $mail->addCC("");
         $mail->addBCC("");

         $mail->isHTML(true);
         $mail->CharSet = 'UTF-8';
         $mail->Subject = "Ticket de compra Gift uwu Store";
         $mail->MsgHTML($body);

        if ($mail->send() && generatePurchase($_SESSION["username"], $items, test_input($_POST["total"]))) {
            echo '<script>
                swal("Tu recibo de pago fue enviado a tu correo", "Si no lo has visto aún, checa el spam.", "success");
                </script>';
        } else {
            echo '<script>
            swal("Lo sentimos...", "Hubo un problema al enviar tu ticket.", "error").then(function() {
                window.location = "../preview.php";
            </script>';
        }

        ?>
    <body id="bootstrap-override" class="bg-color">
        <?php
        include("../header/header-login.php");
        ?>
        <section>
            <div class="container">
                <div class="contenedor-central contenedor-flex row">
                <div class="contenedor-padre">
                    <div class="contenedor-hijo contenedor-flex row">
                        <header class="bg-black text-light text-center font-paytone display-1">Gracias por tu compra</header>
                        <div class="space bg-color4 shadow p-5 text-light">
                            <h1 class="text-center">
                                Tu compra ha sido realizada, ¡Que la disfrutes!
                            </h1>
                        </div>
                        <div class="shadow p-5 bg-body-tertiary fs-4">
                            <p>Haremos entrega en: <?php echo test_input($_POST["domicilio"]) ?></p>
                            <p>A nombre de: <?php echo test_input($_POST["name"]) ?></p>
                            <hr>
                            <p>Devolver siempre es gratis, si el producto que recibiste no te agradó cuentas con <strong>30 dias para realizar la devolución.</strong></p><br>
                            <p class="font-paytone text-center">¡gracias por tu preferencia! uwu</p>
                            <p class="fw-light fst-italic fs-6 text-start">Atte: El equipo de <strong>GIFT UWU STORE</strong></p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="container py-3 text-center">
                <form action="./thank-you-pdf.php" method="post">
                    <input type="hidden" name="domicilio" value="<?php echo $_POST["domicilio"] ?>">
                    <input type="hidden" name="pago" value="<?php echo $_POST["pago"] ?>">
                    <input type="hidden" name="total" value="<?php echo $_POST["total"] ?>">
                    <input type="hidden" name="coupondis" value="<?php echo $_POST["coupondis"] ?>">
                    <input type="hidden" name="totalest" value="<?php echo $_POST["totalest"] ?>">
                    <input type="hidden" name="taxes" value="<?php echo $_POST["taxes"] ?>">
                    <input type="hidden" name="totaltaxes" value="<?php echo $_POST["totaltaxes"] ?>">
                    <input type="hidden" name="shipment" value="<?php echo $_POST["shipment"] ?>">
                    <input type="hidden" name="totalship" value="<?php echo $_POST["totalship"] ?>">
                    <input type="hidden" name="name" value="<?php echo $_POST["name"] ?>">
                    <input type="hidden" name="mail" value="<?php echo $_POST["mail"] ?>">
                    <button class="btn btn-dark btn-lg" formtarget="_blank" type="submit" name="submit">Ver Ticket en PDF</button>
                </form>
            </div>
        </section>
        <?php
        include("../footer/footer.php");
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
</body>
</html>