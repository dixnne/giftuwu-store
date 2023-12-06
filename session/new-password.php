<?php
session_start();
if (!isset($_SESSION["userdenied"])) {
    header("Location: ../index.php");
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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body id="bootstrap-override" class="bg-color">
        <?php
        include("../header/header.html");
        require("../database/db-setup.php");
        require("../database/db-handle.php");

        $username = $_SESSION["userdenied"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = $_POST["password"];
            $username = $_SESSION["userdenied"];
        } 

        $hash = password_hash($password, PASSWORD_BCRYPT);
        if (isset($_POST["submit"])) {
            if (updtatePassword($username, $hash) && allowUser($username)) {
                $_SESSION["userdenied"] = "";
                echo '<script>
                swal("Contraseña actualizada!", "Gracias por tu preferencia...", "success").then(function() {
                    window.location = "./login.php";
                });
                </script>';
            } else {
                echo '<script>
                swal("Ups!", "Hubo un error al actualizar la contraseña...", "error");
                </script>';
            }
            
        }
        ?>
        <section id="form">
            <h1 class="text-center font-paytone mt-5">Recupera tu contraseña</h1>
            <div class="container col-12 col-md-6 p-5 bg-color2 mb-5 rounded-5 shadow">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="row needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="col-12 col-md-6 p-2">
                        <label for="inputPassword" class="form-label">Contraseña</label>
                        <input type="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" id="inputPassword" class="form-control" aria-describedby="passwordHelpBlock" required>
                        <div id="passwordHelpBlock" class="form-text">
                            Tu contraseña debe de tener de 8 a 20 caracteres.
                        </div>
                        <div class="invalid-feedback">
                            Tienes que ingresar una contraseña.
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-2">
                        <label for="inputConfirmPassword" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="confirm-password" value="<?php echo isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '' ?>" id="inputConfirmPassword" class="form-control" aria-describedby="confirmpasswordHelpBlock" required>
                        <div id="confirmpasswordHelpBlock" class="form-text">
                            Repite tu contraseña para validarla!
                        </div>
                        <div class="invalid-feedback">
                            Tienes escribir de nuevo la contraseña.
                        </div>
                    </div>
                    <p id="message" class="text-center"></p>
                    <div class="col-12 text-center">
                        <button type="submit" name="submit" class="btn btn-dark w-100">Iniciar sesión</button>
                    </div>
                </form>
            </div>
        </section>
        <?php
        include("../footer/footer.html");
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="./validation.js" async defer></script>
    </body>
</html>