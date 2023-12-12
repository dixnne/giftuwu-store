<?php
    session_start();
    require("../database/db-setup.php");
    require("../database/db-handle.php");
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/style-store.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body id="bootstrap-override" class="bg-color">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
                if (!isset($_SESSION["username"])) {
                    echo '<script>
                    swal("Identifícate", "Para acceder tienes que iniciar sesión.", "error").then(function() {
                        window.location = "../session/login.php";
                    });
                    </script>';
                }
                if (addCartItem($_SESSION["username"], test_input($_POST["submit"]), 1)) {
                    echo '<script>
                    swal("Artículo añadido!", "Gracias por tu preferencia...", "success");
                    </script>';
                } else {
                    echo '<script>
                    swal("Ups!", "Hubo un error al añadir el artículo...", "error");
                    </script>';
                }
                $_POST["submit"] = "";
            }
            if (isset($_SESSION["username"])) {
                include("../header/header-login.php");
            }else{
                include("../header/header.html");
            }
            include("filterNav.html");
        ?>
        <section id="bodyproducts" class="gradient-background-purple py-5">
            <div class="container">
                <div id="conteinercards"  class="row g-4">
        <?php
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
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $name = $row["name"];
                    $category = $row["category"];
                    $price = $row["price"];
                    $stock = $row["stock"];
                    $discount = $row["discount"];
                    $code = $row["code"];
                    $details = $row["details"];
                    $image = $row["image"];
                    if ($stock == 0) {
                        $stock = "Producto agotado";
                    } else {
                        $stock = "Disponibles: ".$stock;
                    }
                    echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3">';
                            $endprice= $price - ($price * $discount/100);
                            if ($discount > 0) {
                                $price = '<span class="text-decoration-line-through">'.$price.'</span>';
                            }
                            echo '<div id="id_'.$id.'" class="card bg-color img-container">';
                                 echo '<img src="'.$image.'" class="card-img-top img-effect" alt="..."">';
                                 echo '<div class="card-body">';
                                     echo '<h5 class="card-title">'.$name.'</h5>';
                                     echo '<p class="card-text">                            
                                     '.$details.' <br>                            
                                      Precio: $'.$price.' |  Descuento: '.$discount.'% <br>
                                      Precio final: $' .$endprice. ' <br>
                                     '.$stock.'
                                     </p>';
                                 echo 'c'; 
                                 echo '<div class="card-footer bg-color2">';
                                    echo '<div class="row row-cols-2">';
                                        echo'<div>';
                                            echo '<small class="text-body-secondary">codigo:'.$code.'</small>';
                                        echo'</div>';
                                        echo'<div class="d-flex justify-content-end">';  
                                            echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post"><button type="submit" name="submit" value="'.$id.'" class="btn btn-dark">Añadir al Carrito</button></form>';
                                        echo'</div>';
                                    echo '</div>';
                                 echo '</div>';   
                             echo '</div>';
                        echo '</div>';   
                }
            }
            $conn->close();     
        ?>
        </div>
        </div>
        </section>
        <?php
        include("../footer/footer.php");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="filters.js"></script>
    </body>
</html>