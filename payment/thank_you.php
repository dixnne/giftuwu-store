<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style-pay.css">
    <title>Thank You!</title>
</head>
<body id="bootstrap-override" class="bg-color">
    <?php
    
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require '../PHPMailer-master/src/Exception.php';
        require '../PHPMailer-master/src/PHPMailer.php';
        require '../PHPMailer-master/src/SMTP.php';
        function sendMail($name, $email, $message){
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
                        Tu compra ha llegado a su destino, ¡Que la disfrutes!
                        </h1>
                    </div>
                    <div class="sombra espacio color-card font-size">
                        <p>Hicimos entrega en //direccion</p>
                        <p>Recibió: //nombre</p>
                        <p>Relación con el titular: Familiar o amigo/a</p>
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
        $_SESSION[""]//recuperar nombre y direccion por post
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
         $mail->addAddress($email);
         
         $mail->addCC("");
         $mail->addBCC("");

         $mail->isHTML(true);
         $mail->CharSet = 'UTF-8';
         $mail->Subject = "Solicitud de Gift uwu Store";
         $mail->MsgHTML($body);
         if ($mail->send()) {
            return true;
        }
        return false;


        }
         //Alerta correo
         if (isset($_POST["submit"])){

            if (confirmMail($name, $email, $message) && sendMail($name, $email, $message)) {
                echo '<script>
                    swal("Tu recibo de pago fue enviado a tu correo", "Si no lo has visto aun, checa el spam", "success");
                    </script>';
            } else {
                echo '<script>
                swal("Lo sentimos...", "Hubo un problema al enviar tu ticket.", "error");
                </script>';
            }
        }  
    ?>
</body>
</html>