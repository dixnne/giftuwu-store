<?php
    session_start();

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
             }else{
                $conn->select_db($dbname);
                $query = 'SELECT * FROM  item';
                $resultado = $conexion -> query($query);
                 if ($resultado -> num_rows){ 
                    
                    echo '<br>';
                     echo '<div id="bodyproducts" class="form container bg-color4 row row-cols-2 row-cols-md-3 g-4">';
                     
                     echo '<br>';
                     
                     while( $fila = $resultado -> fetch_assoc()){                         
                        echo '<div class="col">';
                            $pricefinal= $fila['price'] - ($fila['price'] * ($fila['discount']/100));
                            echo '<div id="id_'.$fila['id'].'" class="card bg-color">';
                                 echo '<img src='. $fila['image'] .' class="card-img-top" alt="..."">';
                                 echo '<div class="card-body">';
                                     echo '<h5 class="card-title">'. $fila['name'] .'</h5>';
                                     echo '<p class="card-text">                            
                                     '. $fila['details'] .' <br>                            
                                      Precio: '. $fila['price'] .' |  Descuento: '. $fila['discount'] .' <br>
                                      Precio final: ' .$pricefinal. ' <br>
                                     '. $fila['stock'] .'
                                     </p>';
                                 echo '</div>'; 
                                 echo '<div class="card-footer bg-color2">';
                                    echo '<div class="row row-cols-2">';
                                        echo'<div>';
                                            echo '<small class="text-body-secondary">codigo:'. $fila['code'] .'</small>';
                                        echo'</div>';
                                        echo'<div class="btn_left">';  
                                            echo '<a href="#"><button type="button" class="btn btn-outline-light btnb">Add</button></a>';
                                        echo'</div>';
                                    echo '</div>';
                                 echo '</div>';   
                             echo '</div>';
                        echo '</div>';                
                     }
                     echo '<br>';
                     echo '<br>';
                     echo '</div>';
                    
                 }
            }  
            $conn->close();     
        ?>
        
        <?php
        include("../footer/footer.html");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="category.js"></script>
    </body>
</html>