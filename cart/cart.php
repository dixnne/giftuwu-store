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
        <link rel="stylesheet" href="../css/style-car.css">
    </head>
    <body id="bootstrap-override" class="bg-color">
        <?php
            if (isset($_SESSION["username"])) {
                include("../header/header-login.php");
            }else{
                include("../header/header.html");
            }
        ?>
        <section class="gradient-background-purple py-5">
            <div class="container">
                <h1 class="text-center">Carrito de Compras</h1>
                <form action="../payment/process.php" method="post">
                    <div class="row">
                        <div class="col-12 col-md-6">
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

                            $user = $_SESSION["username"];
                            $tot_neto = $total_est = $descuento = 0;
                            $query = "SELECT * FROM cart WHERE user='$user'";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $itemid = $row["item"];
                                    $query = "SELECT * FROM item WHERE id='$itemid'";
                                    $itemres = $conn->query($query);
                                    if ($itemres->num_rows > 0) {
                                        while ($item = $itemres->fetch_assoc()) {
                                            $pricefinal= ($item['price'] - ($item['price'] * ($item['discount']/100)))*$row["quantity"];
                                            $tot_neto += $item['price']*$row["quantity"];
                                            $descuento +=$item['price'] * ($item['discount']/100);
                                            $total_est += $pricefinal;

                                            echo '<div id="id_'.$item['id'].'" class="card mb-3" style="max-width: 700px;">';
                                                echo '<div class="row g-0">';
                                                    echo '<div class=" col-md-2 d-flex align-items-center justify-content-center">';
                                                        echo '<div class="form-group d-flex align-items-center justify-content-center">';
                                                            echo '<label><input type="checkbox" class="form-check-input" name="items[]" value="'.$item['id'].'" checked></label> ';
                                                        echo '</div>';
                                                    echo '</div>';
                                                    echo '<div class="col-md-3">';
                                                        echo '<div>';
                                                            echo '<img src='. $item['image'] .' class="img-fluid rounded-start" alt="...">';
                                                        echo '</div>';
                                                    echo '</div>';
                                                    echo '<div class="col-md-5">';
                                                        echo '<div class="card-body">';
                                                            echo '<h5 class="card-title">'. $item['name'] .'</h5>';
                                                            echo '<p class="card-text">                            
                                                                '. $item['details'].'</p>';
                                                            if ($item['discount']>=0.01) {
                                                                echo '<p class="text-decoration-line-through"> Precio Unitario: $'. $item['price'].'</p>';
                                                                echo '<p class="card-text"> Descuento: '.$item['discount'].'%</p>';   
                                                            }else{
                                                                echo '<p> Precio Unitario: $'. $item['price'].'</p>';
                                                            }
                                                            echo '<p class="card-text lead bg-color1 p-2 rounded"> Precio final: $'.$pricefinal.'</p>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                    echo '<div class="bg-color2 col-md-2 d-flex align-items-center justify-content-center">';
                                                        echo '<div class="form-group d-flex align-items-center justify-content-center">';
                                                            echo '<label><input class="form-control" style="max-width: 50px;" type="number" min="1" max="'. $item['stock'] .'" name="quantity[]" value="'.$row["quantity"].'" ></label> ';
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>'; 
                                        }
                                    }
                                }
                            }
                            $conn->close(); 
                            ?>
                        </div>
                        <div class="col-12 col-md-6 px-3">
                            <div class="bg-dark p-4 rounded">
                                <div class="bg-light p-3 rounded">
                                    <small class="text-body-secondary">La disponibilidad y el precio 
                                    de los articulos no estan garantizados hasta que se finalice el pago</small>
                                </div>
                                <hr>
                                <div>
                                    <h2 class="text-white"> Hagamos cuentas</h2>
                                    <p class="crossline text-white"> Total en articulos: $<?php echo $tot_neto; ?> </p>
                                    <p class="text-white"> Descuento: $<?php echo $descuento; ?></p>
                                    <p class="lead text-white"> Total estimado: $<?php echo $total_est; ?></p>
                                </div>
                            </div>
                            <div class="form-group bg-light text-center py-4 rounded mt-4">
                                <button class="btn btn-dark w-50" name="submit" type="submit">Ir a pagar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <?php
        include("../footer/footer.php");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>