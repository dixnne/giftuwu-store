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

                $name = $email = $message = "";
                $name = test_input($_POST["name"]);
                $email = test_input($_POST["email"]);
                $message = test_input($_POST["message"]);
            }

            if (isset($_POST["submit"])){

                if (confirmMail($name, $email, $message) && sendMail($name, $email, $message)) {
                    echo '<script>
                        swal("Bienvenido a Gift uwu Store!", "Se envió la solicitud a Gift uwu Store", "success");
                        </script>';
                } else {
                    echo '<script>
                    swal("Lo sentimos...", "Hubo un problema al enviar tu solicitud.", "error");
                    </script>';
                }
            }

        function confirmMail($name, $email, $message){

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
                <H1>Gracias por contactarnos, ".$name."</H1><br>
                <p>Tu solicitud está siendo procesada, estaremos comunicándonos próximamente al respecto.</p>
                <p>Tu solicitud fue: ".$message."</p>
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
            $mail->Subject = "Solicitud de Gift uwu Store";
            $mail->MsgHTML($body);
            if ($mail->send()) {
                return true;
            }
            return false;
        }

        function sendMail($name, $email, $message){

            $mail = new PHPMailer();
            $body = "<!DOCTYPE html>
            <html>
            <head>
                <title>Contacto</title>
                <style>
                    body{
                        font-family: Verdana, Geneva, Tahoma, sans-serif;
                    }
                </style>
            </head>
            <body>
                <p>Nombre: ".$name."</p>
                <p>Correo electrónico: ".$email."</p>
                <p>Su solicitud fue: ".$message."</p>
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
            $mail->addAddress('wearedevs.psw@gmail.com');
            
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

        ?>
        <section id="form">
            <h1 class="text-center font-paytone mt-5">Contáctanos</h1>
            <div class="container col-12 col-md-6 p-5 bg-color3 mb-5 rounded-5 shadow">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="row needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="col-12 p-2">
                        <label for="inputName" class="form-label text-white">Nombre Completo</label>
                        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" id="inputName" class="form-control" required>
                        <div class="invalid-feedback">
                            Muestra al mundo tu bello nombre!
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <label for="inputEmail" class="form-label text-white">Correo Electrónico</label>
                        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" id="inputEmail" class="form-control" required>
                        <div class="invalid-feedback">
                            Ingresa tu correo electrónico.
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <label for="exampleFormControlTextarea1" class="form-label text-white">Mensaje</label>
                        <textarea class="form-control" name="message" id="exampleFormControlTextarea1" required rows="3"><?php echo isset($_POST['message']) ? $_POST['message'] : '' ?></textarea>
                        <div class="invalid-feedback">
                            Ingresa tu mensaje.
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" name="submit" class="btn btn-dark w-100">Enviar</button>
                    </div>
                </form>
            </div>
        </section>
        <?php
        include("./footer/footer.php");
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="./session/validation.js" async defer></script>
    </body>
</html>