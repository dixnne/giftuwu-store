<?php
session_start();
require("../database/db-setup.php");
require("../database/db-handle.php");
if (!isset($_SESSION["username"]) || $_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["submit"])) {
    header("Location: ../session/login.php");
}
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
        foreach ($_SESSION["cart"] as $item) {
            AddText($pdf,utf8_decode($item), 10, $coordinatey, 'L', 'Helvetica','',10,0,0,0);
            $coordinatey +=5;
        }
        $_SESSION["cart"] = "";

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