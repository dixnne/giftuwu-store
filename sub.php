<?php
    session_start();
    require("./database/db-setup.php");
    require("./database/db-handle.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gift uwu Store</title>
        <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/images.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body id="bootstrap-override" class="bg-color">
        <?php
            if (isset($_SESSION["username"])) {
                include("./header/header-login-index.php");
            }else{
                include("./header/header-index.html");
            }

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

            require './PHPMailer-master/src/Exception.php';
            require './PHPMailer-master/src/PHPMailer.php';
            require './PHPMailer-master/src/SMTP.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = test_input($_POST["email"]);
            }

            if (isset($_POST["submit"])){

                if (subMail($email)) {
                    echo '<script>
                        swal("Bienvenido a Gift uwu Store!", "Se envió la suscripción a Gift uwu Store", "success").then(function() {
                            window.location = "./index.php";
                        });
                        </script>';
                } else {
                    echo '<script>
                    swal("Lo sentimos...", "Hubo un problema al enviar tu suscripción.", "error").then(function() {
                        window.location = "./index.php";
                    });
                    </script>';
                }
            }

        function subMail($email){

            $mail = new PHPMailer();
            $body = "<!DOCTYPE html>
            <html>
            <head>
                <title>Gracias por contactarnos!</title>
                <style>
                    body{
                        font-family: Verdana, Geneva, Tahoma, sans-serif;
                    }
                </style>
            </head>
            <body>
                <H1>Gracias por suscribirte!</H1><br>
                <img src='cid:coupon' width='800px'><br>
                <p>Atentamente, Gift uwu Store</p>
            </body>
            </html>";

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
            $mail->Subject = "Suscripción a Gift uwu Store";
            $mail->AddEmbeddedImage('./images/Cupon de Bienvenida.png', 'coupon');
            $mail->MsgHTML($body);
            if ($mail->send()) {
                return true;
            }
            return false;
        }
        ?>
        <?php
        include("./footer/footer-fixed.php");
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="./session/validation.js" async defer></script>
    </body>
</html>