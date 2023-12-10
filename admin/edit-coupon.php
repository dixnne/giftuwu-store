<?php
    session_start();
    require("../database/db-setup.php");
    require("../database/db-handle.php");
    if (isset($_SESSION["username"]) && isAdmin($_SESSION["username"])) {
        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin - Gift uwu Store</title>
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/styles.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body id="bootstrap-override" class="bg-color">
        <?php
            require("../header/header-admin-login.php");

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            
                $name = $code = $details = $price = $stock = $image = $discount = $percentage = "";
                $name = test_input($_POST["coupon-name"]);
                $code = test_input($_POST["coupon-code"]);
                $details = test_input($_POST["coupon-details"]);
                $discount = test_input($_POST["coupon-discount"]);
                if (isset($_POST["coupon-apply"])) {
                    $item = test_input($_POST["coupon-item"]);
                    $general = 0;
                } else {
                    $item = 0;
                    $general = 1;
                }
    
                if (!isset($_POST["img"])) {
                    $image = $_FILES['coupon-image'];
                    $imagename = $_FILES['coupon-image']['name'];
                    $imagetype = $_FILES['coupon-image']['type'];
                    $imageerror = $_FILES['coupon-image']['error'];
                    $imagetemp = $_FILES['coupon-image']['tmp_name'];
                    $imagePath = "../images/uploads/";
                    move_uploaded_file($_FILES["coupon-image"]["tmp_name"], $imagePath.$imagename) or die("No se pudo subir el archivo.");
                    $image = $imagePath.$imagename;
                } else {
                    $image = $_POST["actual-image"];
                }
                $id = $_POST["id"];

                if (modifyCoupon($id, $name, $code, $details, $discount, $image, $general, $item)) {
                    echo '<script>
                    swal("Cupón editado!", "Se editó el cupón en la base de datos exitosamente.", "success");
                    </script>';
                } else {
                    echo '<script>
                    swal("Lo sentimos...", "Hubo un error al editar el cupón.", "error");
                    </script>';
                }
            }

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
    
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])){
                $id = test_input($_POST["coupon-id"]);
                $query = "SELECT * FROM coupon WHERE id='$id'";
                $result = $conn->query($query);
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()) {
                        $name = $row["name"];
                        $code = $row["code"];
                        $details = $row["details"];
                        $discount = $row["discount"];
                        $general = $row["general"];
                        $item = $row["item"];
                        $image = $row["image"];
                    }
                }
            }
        ?>
        <div class="container mt-3 d-flex flex-column align-items-center px-5">
            <span class="font-paytone text-center color2 h3">Editar cupón</span>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="row bg-color1 col-8 rounded-4 py-2 px-4 mb-4">
                <div class="col-8">
                    <div class="input-group">
                        <label class="input-group-text" for="coupon-id">Cupón</label>
                        <select class="form-select" id="coupon-id" name="coupon-id" required>
                            <?php
                            $query = "SELECT * FROM coupon";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                }
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Tienes que elegir un cupón.
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" name="search" class="mx-3 btn btn-dark">Editar</button>
                </div>
            </form>
            <div class="p-2 p-lg-4 rounded-4 bg-color2 shadow w-100">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="row" enctype="multipart/form-data" novalidate>
                    <div class="col-12 col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" value="<?php echo isset($name) ? $name : '' ?>" id="coupon-name" name="coupon-name" required>
                            <label for="coupon-name">Nombre del artículo</label>
                            <div class="invalid-feedback">
                                Es necesario un nombre para el cupón!
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" value="<?php echo isset($code) ? $code : '' ?>" id="coupon-code" name="coupon-code" required>
                            <label for="coupon-code">Código</label>
                            <div class="invalid-feedback">
                                Es necesario para identificar tu cupón!
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control"  value="<?php echo isset($discount) ? $discount : '' ?>" name="coupon-discount" id="coupon-discount" placeholder="0.00">
                                <label for="coupon-discount">Descuento</label>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="coupon-details" id="coupon-details" style="height: 100px" required><?php echo isset($details) ? $details : '' ?></textarea>
                            <label for="coupon-details">Descripción</label>
                            <div class="invalid-feedback">
                                Todos quieren saber hasta el mínimo detalle...
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="coupon-image" class="form-label text-white">Imagen del cupón</label>
                            <input class="form-control" type="file" onchange="loadFile(event)" id="coupon-image" name="coupon-image">
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" value="img" role="switch" name="img" id="img">
                            <label class="form-check-label text-white" for="img">Dejar imagen actual</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" value="item" role="switch" name="coupon-apply" id="coupon-apply" <?php echo isset($general) ? ($general == 0 ? "checked" : "") : "" ?>>
                            <label class="form-check-label text-white" for="coupon-apply">Aplicar a artículo en específico</label>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="coupon-item">Artículo</label>
                            <select class="form-select" id="coupon-item" name="coupon-item" required>
                                <?php
                                $query = "SELECT * FROM item";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0){
                                    while ($row = $result->fetch_assoc()) {
                                        if ($item == $row["id"]) {
                                            $selected = " selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Tienes que elegir un artículo.
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <p class="text-white">Imagen actual</p>
                        <img class="img-fluid px-3" src="<?php echo isset($image) ? $image : '' ?>" alt="">
                    </div>
                    <input type="hidden" id="actual-image" name="actual-image" value="<?php echo isset($image) ? $image : '' ?>">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <div class="col-12 text-center mt-3">
                        <button class="btn btn-outline-dark w-25 mx-3" id="preview-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-preview" aria-controls="offcanvasExample">
                            Vista Previa
                        </button>
                        <button name="submit" class="btn btn-dark w-25 mx-3" type="submit">Editar</button>
                    </div>
                </form>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-preview" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Vista previa del producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <img src="" alt="Preview" class="p-3 rounded img-fluid" id="output">
                        <p>Nombre: <span id="name"></span></p>
                        <p>Código: <span id="code"></span></p>
                        <p>Descripción: <span id="details"></span></p>
                        <p>Detalles:</p>
                        <ul>
                            <li>Artículo: <span id="item"></span></li>
                            <li>Descuento: <span id="discount"></span>%</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php $conn->close(); ?>
        </div></div></div></section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../session/validation.js" async defer></script>
        <script src="./coupons.js"></script>
    </body>
</html>
<?php
    } else {
        header("Location: ./index.php");
    }
    
?>