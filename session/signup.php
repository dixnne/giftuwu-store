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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            require("../database/db-setup.php");
            require("../database/db-handle.php");

            $name = $email = $username = $password = $image = $bday = $question = $answer = "";
            $currentPurchase = 1;
            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $username = test_input($_POST["username"]);
            $password = test_input($_POST["password"]);
            $bday = test_input($_POST["bday"]);
            $question = test_input($_POST["question"]);
            $answer = test_input($_POST["answer"]);

            $hash = password_hash($password, PASSWORD_BCRYPT);

            $image = $_FILES['image'];
            $imagename = $_FILES['image']['name'];
            $imagetype = $_FILES['image']['type'];
            $imageerror = $_FILES['image']['error'];
            $imagetemp = $_FILES['image']['tmp_name'];
            $imagePath = "../images/uploads/";
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath.$imagename) or die("No se pudo subir el archivo.");
            $image = $imagePath.$imagename;
        }

        if (isset($_POST["submit"])){
            if (!isUser($username)) {
                if (insertClient($username, $name, $email, $hash, $question, $answer, $image, $bday, $currentPurchase)) {
                    echo '<script>
                    swal("Bienvenido a Gift uwu Store!", "Se creó la cuenta exitosamente.", "success").then(function() {
                        window.location = "./login.php";
                    });
                    </script>';
                } else {
                    echo '<script>
                    swal("Ups!", "Hubo un problema al crear tu cuenta, inténtalo de nuevo.", "error");
                    </script>';
                    }
            } else {
                echo '<script>
                swal("Lo sentimos...", "Ese usuario ya está en uso.", "warning");
                </script>';
            }
        }
        ?>
        <section id="form">
            <h1 class="text-center font-paytone mt-5">Crea tu cuenta</h1>
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
                    <div class="col-12 bg-color1 rounded p-3 mt-2">
                        <div class="row">
                            <div class="col-12 p-2">
                                <label for="inputUser" class="form-label">Nombre de Usuario</label>
                                <input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" id="inputUser" class="form-control" aria-describedby="userHelpBlock" required>
                                <div id="userHelpBlock" class="form-text">
                                    Intenta escoger un usuario único y especial como tú!
                                </div>
                                <div class="invalid-feedback">
                                    Tenemos que identificarte con algo...
                                </div>
                            </div>
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
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-2">
                        <label for="formFile" class="form-label text-white">Foto</label>
                        <input class="form-control" name="image" type="file" id="formFile" aria-describedby="fileHelpBlock" required>
                        <div id="fileHelpBlock" class="form-text text-white">
                            Se recomienda elegir una foto en la que se vea tu rostro por motivos de identidad.
                        </div>
                        <div class="invalid-feedback">
                            Ingresa una fotografía.
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-2">
                        <label for="inputBday" class="form-label text-white">Fecha de Nacimiento</label>
                        <input class="form-control" name="bday" value="<?php echo isset($_POST['bday']) ? $_POST['bday'] : '' ?>" type="date" id="inputBday" aria-describedby=" bdayHelpBlock" required>
                        <div id="bdayHelpBlock" class="form-text text-white">
                            ¿Quién sabe? Quizá recibas algo de cumpleaños...
                        </div>
                        <div class="invalid-feedback">
                            ¿Cuándo cumples años? Necesito preparar tu regalo.
                        </div>
                    </div>
                    <div class="col-12 bg-color2 rounded p-3 my-2">
                        <div class="row">
                            <div class="col-12 col-md-6 p-2">
                                <label for="inputQuestion" class="form-label">Pregunta de Seguridad</label>
                                <input type="text" name="question" value="<?php echo isset($_POST['question']) ? $_POST['question'] : '' ?>" id="inputQuestion" class="form-control" aria-describedby="userHelpBlock" required>
                                <div id="userHelpBlock" class="form-text">
                                    Pregunta algo que solo sepas tú.
                                </div>
                                <div class="invalid-feedback">
                                    Quiero saber más de tí!
                                </div>
                            </div>
                            <div class="col-12 col-md-6 p-2">
                                <label for="inputAnswer" class="form-label">Respuesta</label>
                                <input type="text" name="answer" value="<?php echo isset($_POST['answer']) ? $_POST['answer'] : '' ?>" id="inputAnswer" class="form-control" aria-describedby="passwordHelpBlock" required>
                                <div id="passwordHelpBlock" class="form-text">
                                    Será nuestro secreto!
                                </div>
                                <div class="invalid-feedback">
                                    Confía en mí, no le diré a nadie.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-check col-12 py-2 px-5">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                        <label class="form-check-label" for="flexCheckDefault">
                            Estoy de acuerdo con los términos y condiciones de Gift uwu Store.
                        </label>
                        <div class="invalid-feedback">
                            Debes de estar de acuerdo para crear tu cuenta...
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" name="submit" class="btn btn-dark w-100">Continuar</button>
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