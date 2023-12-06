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
            
                $id = "";
                $id = test_input($_POST["id"]);

                if (deleteItem($id)) {
                    echo '<script>
                    swal("Artículo eliminado!", "Se eliminó el artículo en la base de datos exitosamente.", "success");
                    </script>';
                } else {
                    echo '<script>
                    swal("Lo sentimos...", "Hubo un error al eliminar el artículo.", "error");
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
                $id = test_input($_POST["item-id"]);
                $query = "SELECT * FROM item WHERE id='$id'";
                $result = $conn->query($query);
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()) {
                        $name = $row["name"];
                        $category = $row["category"];
                        $price = $row["price"];
                        $stock = $row["stock"];
                        $discount = $row["discount"];
                        $code = $row["code"];
                        $details = $row["details"];
                        $image = $row["image"];
                    }
                }
            }
        ?>
        <div class="container mt-3 d-flex flex-column align-items-center px-5">
            <span class="font-paytone text-center color3 h3">Eliminar producto</span>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="row bg-color1 col-8 rounded-4 py-2 px-4 mb-4">
                <div class="col-8">
                    <div class="input-group">
                        <label class="input-group-text" for="item-id">Artículo</label>
                        <select class="form-select" id="item-id" name="item-id" required>
                            <?php
                            $query = "SELECT * FROM item";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                }
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Tienes que elegir una categoría.
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" name="search" class="mx-3 btn btn-dark" id="preview-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-preview">Eliminar</button>
                </div>
            </form>
            <div class="p-2 p-lg-4 rounded-4 bg-color1 shadow w-100">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" novalidate>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <img class="img-fluid p-3" src="<?php echo isset($image) ? $image : '' ?>" alt="">
                        </div>
                        <div class="col-12 col-md-8 d-flex flex-column justify-content-center">
                            <h5>Nombre del artículo: <?php echo isset($name) ? $name : '' ?></h5>
                            <p>Código: <?php echo isset($code) ? $code : '' ?></p>
                            <p><?php echo isset($details) ? $details : '' ?></p>
                        </div>
                        <div class="col-12 p-3">
                            <table class="table table-hover table-dark">
                                <tr>
                                    <th>Categoría</th>
                                    <td><?php echo isset($category) ? $category : '' ?></td>
                                    <th>Precio</th>
                                    <td>$<?php echo isset($price) ? $price : '' ?></td>
                                </tr>
                                <tr>
                                    <th>Descuento</th>
                                    <td><?php echo isset($discount) ? $discount.'%' : 'No hay descuento.' ?></td>
                                    <th>Existencias</th>
                                    <td>$<?php echo isset($stock) ? $stock : '' ?></td>
                                </tr>
                            </table>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="text-center">
                                <button name="submit" class="btn btn-dark w-25 mt-3" type="submit">Eliminar permanentemente</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php $conn->close(); ?>
        </div></div></div></section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../session/validation.js" async defer></script>
        <script src="./items.js"></script>
    </body>
</html>
<?php
    } else {
        header("Location: ./index.php");
    }
    
?>