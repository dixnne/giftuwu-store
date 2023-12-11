<?php
session_start();
require("../database/db-setup.php");
require("../database/db-handle.php");
if (!isset($_SESSION["username"]) || $_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["submit"])) {
    header("Location: ../session/login.php");
}
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require '../PHPMailer-master/src/Exception.php';
        require '../PHPMailer-master/src/PHPMailer.php';
        require '../PHPMailer-master/src/SMTP.php';
        require('../fpdf/fpdf.php');

        $today = getdate();
        $date = $today["year"]."-".$today["mon"]."-".$today["mday"];
        $date = new DateTime($date, new DateTimeZone('America/Mexico_City'));
        

        $pdf = new FPDF('P','mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->SetCreator('Gift uwu Store');

        $pdf->SetMargins(20, 20, 20);
        $pdf->SetDrawColor(122, 69, 121);
        $pdf->SetLineWidth(5);
        $pdf->Rect(0, 0, 216, 279);

        $pdf->Image('../images/logo.png', 10, 10, 18);
        AddText($pdf,"Gift uwu Store", 30, 10, 'L', 'Helvetica','B',20,0,0,0);
        AddText($pdf, $date->format('d-m-Y'), 30, 17, 'L', 'Helvetica','',15,0,0,0);
        AddText($pdf,"Los regalos mas uwu a los precios menos unu!", 10, 10, 'R', 'Helvetica','I',15,0,0,0);
        AddText($pdf,utf8_decode("Cliente: ".test_input($_POST["name"])), 10, 27, 'L', 'Helvetica','',10,0,0,0);
        AddText($pdf,utf8_decode("Domicilio: ".test_input($_POST["domicilio"])), 10, 31, 'L', 'Helvetica','',10,0,0,0);
        AddText($pdf,utf8_decode("Devolver siempre es gratis, si el producto que recibiste no te agradó cuentas con 30 dias para realizar la devolución."), 10, 35, 'L', 'Helvetica','',10,0,0,0);
        AddText($pdf,utf8_decode("¡Gracias por tu preferencia! uwu"), 10, 39, 'L', 'Helvetica','',10,0,0,0);

        AddText($pdf,utf8_decode("Artículos a recibir: "), 10, 50, 'L', 'Helvetica','',10,0,0,0);
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

        $coordinatey = 60;
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
                        AddText($pdf,utf8_decode($item["name"]), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
                        $coordinatey +=5;
                    }
                }
            }
        }

        $conn->close();
        $coordinatey += 7;
        AddText($pdf,utf8_decode("Descuento en cupón: $".test_input($_POST["coupondis"])), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
        $coordinatey += 5;
        AddText($pdf,utf8_decode("Total sin deducciones: $".test_input($_POST["totalest"])), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
        $coordinatey += 7;
        AddText($pdf,utf8_decode("Impuestos: $".test_input($_POST["taxes"])), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
        $coordinatey += 5;
        AddText($pdf,utf8_decode("Total con impuestos: $".test_input($_POST["totaltaxes"])), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
        $coordinatey += 7;
        AddText($pdf,utf8_decode("Envío: $".test_input($_POST["shipment"])), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
        $coordinatey += 5;
        AddText($pdf,utf8_decode("Total con envío: $".test_input($_POST["totalship"])), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
        $coordinatey += 7;
        AddText($pdf,utf8_decode("Método de pago: ".test_input($_POST["pago"])), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
        $coordinatey += 5;
        AddText($pdf,utf8_decode("Haremos entrega en: ".test_input($_POST["domicilio"])), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
        $coordinatey += 5;
        AddText($pdf,utf8_decode("A nombre de: ".test_input($_POST["name"])), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
        $coordinatey += 10;
        AddText($pdf,utf8_decode("Total a pagar: $".test_input($_POST["total"])), 10, $coordinatey, 'L', 'Helvetica','',15,0,0,0);
        $pdf->Output("giftuwu-ticket.pdf", "I");


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

        //$name = text to be added, $x= x cordinate, $y = y coordinate, $a = alignment , $f= Font Name, $t = Bold / Italic, $s = Font Size, 
        //$r = Red, $g = Green Font color, $b = Blue Font Color
        function AddText($pdf, $text, $x, $y, $a, $f, $t, $s, $r, $g, $b) {
            $pdf->SetFont($f,$t,$s);	
            $pdf->SetXY($x,$y);
            $pdf->SetTextColor($r,$g,$b);
            $pdf->Cell(0,10,$text,0,0,$a);	
        }
    ?>
</body>
</html>