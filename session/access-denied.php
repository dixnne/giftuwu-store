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

        if (!isUser($username)) {
            echo '<script>
                swal("Acceso Denegado", "La cuenta que ingresaste no existe...", "error").then(function() {
                    window.location = "./login.php";
                });
                </script>';
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $row = getClient($username);
            $answer = test_input($_POST["answer"]);
        } 
        
        if (isset($_POST["submit"])) {
            if ($row["answer"] == $answer) {
                echo '<script>
                swal("Correcto!", "Ahora solo queda establecer tu nueva contraseña...", "success").then(function() {
                    window.location = "./new-password.php";
                });
                </script>';
            } else {
                echo '<script>
                swal("Incorrecto!", "La respuesta que ingresaste no coincide...", "error");
                </script>';
            }
            
        }
        ?>
        <section id="form">
            <h1 class="text-center font-paytone mt-5">Recupera tu contraseña</h1>
            <div class="container col-12 col-md-6 p-5 bg-color4 mb-5 rounded-5 shadow">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="row needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="col-12 col-md-6 p-2">
                        <label for="inputUser" class="form-label">Pregunta de Seguridad</label>
                        <input type="text" name="username" value="<?php $row = getClient($username); echo $row["question"]; ?>" id="inputUser" class="form-control" aria-describedby="userHelpBlock" disabled>                      
                    </div>
                    <div class="col-12 col-md-6 p-2">
                        <label for="inputPassword" class="form-label">¿Cuál es la respuesta?</label>
                        <input type="text" name="answer" value="<?php echo isset($_POST['answer']) ? $_POST['answer'] : '' ?>" id="inputAnswer" class="form-control" aria-describedby="answerHelpBlock" required>
                        <div id="answerHelpBlock" class="form-text">
                            Piénsalo bien...
                        </div>
                        <div class="invalid-feedback">
                            Tienes que ingresar una respuesta.
                        </div>
                    </div>
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