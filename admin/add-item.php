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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
                $name = $category = $code = $details = $price = $stock = $image = $discount = $percentage = "";
                $name = test_input($_POST["item-name"]);
                $category = test_input($_POST["item-category"]);
                $code = test_input($_POST["item-code"]);
                $details = test_input($_POST["item-details"]);
                $price = test_input($_POST["item-price"]);
                $stock = test_input($_POST["item-stock"]);
                if (isset($_POST["item-discount"])) {
                    $discount = test_input($_POST["item-per"]);
                } else {
                    $discount = 0;
                }
    
                $image = $_FILES['item-image'];
                $imagename = $_FILES['item-image']['name'];
                $imagetype = $_FILES['item-image']['type'];
                $imageerror = $_FILES['item-image']['error'];
                $imagetemp = $_FILES['item-image']['tmp_name'];
                $imagePath = "../images/uploads/";
                move_uploaded_file($_FILES["item-image"]["tmp_name"], $imagePath.$imagename) or die("No se pudo subir el archivo.");
                $image = $imagePath.$imagename;
            }
    
            if (isset($_POST["submit"])){
                if (insertItem($name, $code, $category, $price, $stock, $discount, $details, $image)) {
                    echo '<script>
                    swal("Artículo añadido!", "Se añadió el artículo a la base de datos exitosamente.", "success");
                    </script>';
                } else {
                    echo '<script>
                    swal("Lo sentimos...", "Hubo un error al insertar el artículo.", "error");
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
            $query = "SELECT * FROM item";
            $result = $conn->query($query);
            $id = $result->num_rows + 3;
        ?>
        <div class="container mt-3 d-flex flex-column align-items-center px-5">
            <span class="font-paytone text-center color3 h3">Añadir producto</span>
            <span class="mb-3 my-2 bg-color1 px-4 py-2 rounded-5">ID de artículo: <?php echo $id ?></span>
            <div class="p-2 p-lg-4 rounded-4 bg-color3 shadow w-100">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="row" enctype="multipart/form-data" novalidate>
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="item-name" name="item-name" required>
                            <label for="item-name">Nombre del artículo</label>
                            <div class="invalid-feedback">
                                Es necesario un nombre para el producto!
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="item-category">Categoría</label>
                            <select class="form-select" id="item-category" name="item-category" required>
                                <?php
                                $query = "SELECT * FROM category";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0){
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                    }
                                }
                                $conn->close();
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Tienes que elegir una categoría.
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="item-code" name="item-code" required>
                            <label for="item-code">Código</label>
                            <div class="invalid-feedback">
                                Es necesario para identificar tu artículo!
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="item-details" id="item-details" style="height: 100px" required></textarea>
                            <label for="item-details">Descripción</label>
                            <div class="invalid-feedback">
                                Todos quieren saber hasta el mínimo detalle...
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <div class="form-floating">
                                <input type="text" class="form-control" name="item-price" id="item-price" placeholder="0.00" required>
                                <label for="item-price">Precio</label>
                                <div class="invalid-feedback">
                                    Ingresa el precio.
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="item-stock" name="item-stock" required>
                            <label for="item-stock">Inventario</label>
                            <div class="invalid-feedback">
                                Queremos saber cuántos hay!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="item-image" class="form-label text-white">Imagen del artículo:</label>
                            <input class="form-control" type="file" onchange="loadFile(event)" id="item-image" name="item-image" required>
                            <div class="invalid-feedback">
                                Demuestra a todos cuán irresistible es tu producto!
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" value="discount" role="switch" name="item-discount" id="item-discount">
                            <label class="form-check-label text-white" for="item-discount">Agregar descuento</label>
                        </div>
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="item-per" id="item-per" placeholder="0.00">
                                <label for="item-per">Porcentaje</label>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button class="btn btn-outline-dark w-25 mx-3" id="preview-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-preview" aria-controls="offcanvasExample">
                            Vista Previa
                        </button>
                        <button name="submit" class="btn btn-dark w-25 mx-3" type="submit">Agregar</button>
                    </div>
                </form>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-preview" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Vista previa del producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <img src="" alt="Preview" class="p-3 rounded img-fluid" id="output">
                        <h6>Id del producto: <?php echo $id ?></h6>
                        <p>Nombre: <span id="name"></span></p>
                        <p>Código: <span id="code"></span></p>
                        <p>Descripción: <span id="details"></span></p>
                        <p>Detalles:</p>
                        <ul>
                            <li>Categoría: <span id="category"></span></li>
                            <li>Precio: $<span id="price"></span></li>
                            <li>Inventario: <span id="stock"></span></li>
                            <li>Descuento: <span id="discount"></span>%</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
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