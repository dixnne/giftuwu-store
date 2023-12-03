<?php
    session_start();

    $category = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Acceder al valor enviado mediante POST
        if (isset($_POST['nueva_variable'])) {
            $nuevo_valor = $_POST['nueva_variable'];
    
            // Procesar el valor recibido (por ejemplo, actualizar la variable)
            // En este ejemplo, simplemente devolvemos el valor recibido como respuesta
            echo $nuevo_valor;
            $category = $nuevo_valor;
        } else {
            echo "No se recibió ningún valor";
        }
    } else {
        echo "No se recibió una solicitud POST";
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
             $servidor='localhost';
             $cuenta='root';
             $password='';
             $bd='girtuwustore';
             
             //conexion a la base de datos
             $conexion = new mysqli($servidor,$cuenta,$password,$bd);
             if ($conexion->connect_errno){
                die('Error en la conexion');
            }else{
                if($category != 0){
                    switch ($opcion) {
                        case 1:                   
                            $sql = 'select * from item where category = 1';
                            break;
                        case 2:
                            $sql = 'select * from item where category = 2';
                            break;
                        case 3:
                            $sql = 'select * from item where category = 3';
                            break;
                        case 4:
                            $sql = 'select * from item where category = 4';
                        break; 
                        case 5:
                            $sql = 'select * from item where category = 5';
                            break;
                        case 6:
                            $sql = 'select * from item where category = 6';
                            break;   
                        default:
                            break;
                    }
                }else{
                    $sql = 'select * from item';
                }
                $resultado = $conexion -> query($sql);
                 if ($resultado -> num_rows){ 
                     $bangroup=0;
                     echo '<div id="bodyproducts" class="container bg-color4 ">';
                     echo '<br>';
                     
                     while( $fila = $resultado -> fetch_assoc()){ 
                        
                         if($bangroup== 0 || $bangroup % 4 == 0){
                             echo '<div class="card-group col contenedor-flex">';
                         }
                            $pricefinal= $fila['price'] - ($fila['price'] * ($fila['discount']/100));
                            
                             echo '<div class="card space bg-color">';
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
                                     echo '<small class="text-body-secondary">codigo:'. $fila['code'] .'</small>';
                                 echo '</div>';   
                             echo '</div>';
                             
                         if($bangroup % 4 == 3 || $resultado -> num_rows== $bangroup +1){
                             echo '</div>';
                             echo '<br>';
                         }
                         $bangroup+=1;
                     }
                     echo '</div>';
                 }
            }       
        ?>
        
        <?php
        include("../footer/footer.html");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="category.js"></script>
    </body>
</html>