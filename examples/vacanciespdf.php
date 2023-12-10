<?php
    session_start();
        $name = $lastname = $phone = $birthday = $birthmonth = $birthyear = $travel = $english = $job = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = test_input($_POST["name"]." ".$_POST["paternal-surname"]." ".$_POST["maternal-surname"]);
            $phone = test_input($_POST["phone"]);
            $birthday = test_input($_POST["birth-day"]);
            $birthmonth = test_input($_POST["birth-month"]);
            $birthyear = test_input($_POST["birth-year"]);
            $travel = test_input($_POST["radio-travel"]);
            $residency = test_input($_POST["radio-residency"]);
            $english = test_input($_POST["radio-english"]);
            $job = test_input($_POST["job"]);

            $image = $_FILES['photo'];
            $imagename = $_FILES['photo']['name'];
            $imagetype = $_FILES['photo']['type'];
            $imageerror = $_FILES['photo']['error'];
            $imagetemp = $_FILES['photo']['tmp_name'];
            $imagePath = "../images/uploads/";
            move_uploaded_file($_FILES["photo"]["tmp_name"], $imagePath.$imagename) or die("No se pudo subir el archivo.");

            $languages = "";
            if(!empty($_POST['lang'])) {    
                foreach($_POST['lang'] as $value){
                    $languages .= $value."   ";
                }
            }
            if($languages == "") $languages = "No se seleccionó ningún lenguaje";

            $key = generateCode(8);
            writeCode($key);

            $today = getdate();
            $date = $today["year"]."-".$today["mon"]."-".$today["mday"];
            $date = new DateTime($date, new DateTimeZone('America/Mexico_City'));
        }

        if(isset($_POST["submit"])){
            require('../fpdf/fpdf.php');

            $pdf = new FPDF('P','mm','Letter');
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);
            $pdf->SetCreator('We are Devs');

            $pdf->SetMargins(20, 20, 20);
            $pdf->SetDrawColor(25, 167, 206);
            $pdf->SetLineWidth(5);
            $pdf->Rect(0, 0, 216, 279);

            $pdf->Image('../images/logo.jpeg', 10, 10, 18);
            AddText($pdf,"We're Devs", 30, 10, 'L', 'Helvetica','B',20,0,0,0);
            AddText($pdf, $date->format('d-m-Y'), 30, 17, 'L', 'Helvetica','',15,0,0,0);
            AddText($pdf,"To see us in the same line!", 10, 10, 'R', 'Helvetica','I',15,0,0,0);
            AddText($pdf,utf8_decode("A continuación, la recopilación de datos del aspirante ".$name.", que se está postulando para ser parte "), 10, 27, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("de la gran familia de We're Devs, en la que creemos fielmente en el apoyo mútuo y trabajo en equipo, en el constante"), 10, 31, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("aprendizaje y en la valoración de todo tipo de ser. We're Devs es y seguirá siendo una empresa completamente fiel a "), 10, 35, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("sus valores, que se ven reflejados en todos y cada uno de sus integrantes."), 10, 39, 'L', 'Helvetica','',10,0,0,0);

            $pdf->Image('../images/uploads/'.$imagename, 20, 50, 30);
            AddText($pdf,utf8_decode("Nombre(s)"), 80, 70, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("Apellido Paterno"), 120, 70, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("Apellido Materno"), 160, 70, 'L', 'Helvetica','',10,0,0,0);
            $pdf->SetDrawColor(20, 108, 148);
            $pdf->SetLineWidth(0.5);
            $pdf->Line(60,70,206,70);
            AddText($pdf,utf8_decode($name), 90, 60, 'L', 'Helvetica','',15,0,0,0);

            $pdf->Line(10,90,103,90);
            $pdf->Line(112,90,206,90);
            AddText($pdf,utf8_decode("Teléfono"), 50, 90, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("Fecha de Nacimiento"), 140, 90, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode($phone), 40, 80, 'L', 'Helvetica','',15,0,0,0);
            AddText($pdf,utf8_decode($birthday." de ".$birthmonth." de ".$birthyear), 130, 80, 'L', 'Helvetica','',15,0,0,0);

            AddText($pdf,utf8_decode("Lenguajes y frameworks que domina"), 80, 110, 'L', 'Helvetica','',10,0,0,0);
            $pdf->Line(10,110,206,110);
            AddText($pdf,utf8_decode($languages), 0, 100, 'C', 'Helvetica','',15,0,0,0);

            $pdf->Line(10,130,67,130);
            $pdf->Line(77,130,139,130);
            $pdf->Line(149,130,206,130);
            AddText($pdf,utf8_decode($travel), 37, 120, 'L', 'Helvetica','',15,0,0,0);
            AddText($pdf,utf8_decode($residency), 105, 120, 'L', 'Helvetica','',15,0,0,0);
            AddText($pdf,utf8_decode($english), 175, 120, 'L', 'Helvetica','',15,0,0,0);
            AddText($pdf,utf8_decode("Disponibilidad para viajar"), 20, 130, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("Disponibilidad para cambio de residencia"), 75, 130, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("Manejo de inglés"), 164, 130, 'L', 'Helvetica','',10,0,0,0);

            AddText($pdf,utf8_decode("Puesto al que aplica"), 0, 150, 'C', 'Helvetica','',10,0,0,0);
            $pdf->Line(10,150,206,150);
            AddText($pdf,utf8_decode($job), 0, 140, 'C', 'Helvetica','',15,0,0,0);

            AddText($pdf,utf8_decode("Para concluir con su solicitud, es necesario que presente su examen de conocimientos básicos, que puede encontar en"), 10, 170, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("la sección de Vacantes de la página. Para ingresar al examen es necesario que utilice la clave que se le proporciona"), 10, 174, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("a continuación, pudiéndolo realizar en el momento que desee."), 10, 178, 'L', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("Clave de acceso al examen: ".$key), 20, 190, 'C', 'Helvetica','',15,0,0,0);

            $pdf->Line(50,240,166,240);
            $pdf->Image('../images/signature.png', 90, 220, 40);
            AddText($pdf,utf8_decode("Directora de We're Devs"), 20, 240, 'C', 'Helvetica','',10,0,0,0);
            AddText($pdf,utf8_decode("Lic. Diana Montserrat Salgado Suárez"), 20, 245, 'C', 'Helvetica','',10,0,0,0);

            $pdf->Output();

        }else {
            echo "no";
        }

        //$name = text to be added, $x= x cordinate, $y = y coordinate, $a = alignment , $f= Font Name, $t = Bold / Italic, $s = Font Size, 
        //$r = Red, $g = Green Font color, $b = Blue Font Color
        function AddText($pdf, $text, $x, $y, $a, $f, $t, $s, $r, $g, $b) {
            $pdf->SetFont($f,$t,$s);	
            $pdf->SetXY($x,$y);
            $pdf->SetTextColor($r,$g,$b);
            $pdf->Cell(0,10,$text,0,0,$a);	
        }

        function test_input($data) {
            $data = trim($data); 
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function  generateCode($length) {
            $character = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!#$%&/=+-@';
            $code = '';
            
            if ($length > strlen($character)) {
                $length = strlen($character);
            }
            
            $caracter = str_shuffle($character); 
            
            for ($i = 0; $i < $length; $i++) {
                $code .= $caracter[$i];
            }
            
            return $code;
        }

        function writeCode($code) {
            $text = $_SESSION["username"]." ".$code."\r\n";
            $file = '../data/codes.txt';
            $handle = fopen($file, "a+");
            if ($handle === false) {
                die('No se puede abrir el archivo');
            }
            if (file_exists($file)) {
                fwrite($handle,$text);
            }
            fclose($handle);
        }
?>