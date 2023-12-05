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
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/style-store.css">
    </head>
    <body id="bootstrap-override" class="bg-color">
        <?php
            if (isset($_SESSION["username"])) {
                include("../header/header-login.php");
            }else{
                include("../header/header.html");
            }
        ?>
        
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

            $query = "SELECT * FROM category WHERE id='2'";
            $result = $conn->query($query);
            ?>
            <section id="bodyproducts" class="gradient-background-purple py-5">
            <?php 
            
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    echo '<h1 class="text-center font-paytone">'.$row["name"].'</h1>
                    <p class="lead text-center mb-3">'.$row["details"].'</p>';
                }
            }
                     
            ?>
            <div class="container">
            <div class="row g-4">
            <?php
        
            $query = "SELECT * FROM item WHERE category='2'";
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
                    echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3">';
                            $endprice= $price - ($price * $discount/100);
                            echo '<div id="id_'.$id.'" class="card bg-color">';
                                 echo '<img src="'.$image.'" class="card-img-top" alt="..."">';
                                 echo '<div class="card-body">';
                                     echo '<h5 class="card-title">'.$name.'</h5>';
                                     echo '<p class="card-text">                            
                                     '.$details.' <br>                            
                                      Precio: $'.$price.' |  Descuento: '.$discount.'% <br>
                                      Precio final: $' .$endprice. ' <br>
                                     '.$stock.'
                                     </p>';
                                 echo '</div>'; 
                                 echo '<div class="card-footer bg-color2">';
                                    echo '<div class="row row-cols-2">';
                                        echo'<div>';
                                            echo '<small class="text-body-secondary">codigo:'.$code.'</small>';
                                        echo'</div>';
                                        echo'<div class="d-flex justify-content-end">';  
                                            echo '<a href="#"><button type="button" class="btn btn-dark">Añadir al Carrito</button></a>';
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
        include("../footer/footer.html");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>