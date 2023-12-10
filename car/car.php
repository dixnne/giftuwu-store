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
    <style>
        #bodycar .color4s{
            background-color: #836096;
        }
    </style>

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
             if ($conexion->connect_errno){
                die('Error en la conexion');
            }else{
                $conn->select_db($dbname);

                $query = "SELECT * FROM item";
                $result = $conn->query($query);
                 if ($resultado -> num_rows){ 
                    
                    echo '<br>';
                    echo '<div id="bodycar" class="form bg-colorblack color4s">';
                        echo '<form action="#" method="post">'; 
                            echo '<br>';
                            echo '<h1 class="colorwhite"> Carrrito de Compras</h1>';
                            echo '<br>';
                            $tot_neto = 0;
                            $total_est = 0;
                            $descuento = 0;
                            while( $fila = $resultado -> fetch_assoc()){ 
                                $pricefinal= $fila['price'] - ($fila['price'] * ($fila['discount']/100));
                                $tot_neto += $fila['price'];
                                $descuento +=$fila['price'] * ($fila['discount']/100);
                                $total_est += $pricefinal;

                                echo '<div id="id_'.$fila['id'].'" class="card mb-3" style="max-width: 700px;">';
                                    echo '<div class="row g-0">';
                                        echo '<div class=" col-md-2">';
                                            echo '<div class="form-group">';
                                                echo '<br><label><input type="checkbox" name="objects" value="'.$fila['id'].'" ></label> ';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="col-md-3">';
                                            echo '<div>';
                                                echo '<img src='. $fila['image'] .' class="img-fluid rounded-start" alt="...">';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="col-md-5">';
                                            echo '<div class="card-body">';
                                                echo '<h5 class="card-title">'. $fila['name'] .'</h5>';
                                                echo '<p class="card-text">                            
                                                    '. $fila['details'].'</p>';
                                                if ($fila['discount']>=0.01) {
                                                    echo '<p class="crossline"> Precio Unitario: '. $fila['price'].'</p>';
                                                    echo '<p class="card-text"> Descuento: '.$fila['discount'].'</p>';   
                                                }else{
                                                    echo '<p> Precio Unitario: '. $fila['price'].'</p>';
                                                }
                                                echo '<p class="card-text"> Precio final: '.$pricefinal.'</p>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="bg-color2 col-md-2">';
                                            echo '<div class="form-group">';
                                                echo '<br><label><input style="max-width: 50px;" type="number" min="1" max="'. $fila['stock'] .'" name="objects" value="1" ></label> ';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';    
                            } 
                            echo '<br>';
                            echo '<div class="bg-colorwhite">';
                                echo '<hr>';
                                echo'<div>';
                                    echo '<small class="text-body-secondary">La disponibilidad y el precio 
                                    de los articulos no estan garantizados hasta que se finalice el pago</small>';
                                echo'</div>';
                                echo '<hr>';
                                echo '<div>';
                                    echo '<br>';
                                    echo '<h2> Hagamos cuentas</h2>';
                                    echo '<p class="crossline"> Total en articulos: '.$tot_neto.' </p>';
                                    echo '<p> Descuento: '.$descuento.'</p>';
                                    echo '<p> Total estimado: '.$total_est.'</p>';
                                    echo '<br>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group bg-colorwhite">';
                                echo '<input class="btn btn-success" type="submit" value="Enviar">';
                            echo '</div>';
                        echo '</form>';
                    echo '</div>';  
                }
                $conn->close(); 
            }       
        ?>
        <?php
        include("../footer/footer.html");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>