<?php
    session_start();
    require("../database/db-setup.php");
    require("../database/db-handle.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['filter'])) {
            $filter = $_POST['filter'];
        } else {
            $filter = 0;
        }
    } else {
        $filter = 0;
    }
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
        <section id="bodyproducts" class="gradient-background-purple py-5">
            <div class="container">
                <div class="row g-4">
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

                $i=0;
                while( $fila = $resultado -> fetch_assoc()){ 
                    $row[$i]["id"] = $fila["id"];
                    $row[$i]["name"] = $fila["name"];
                    $row[$i]["category"] = $fila["category"];
                    $row[$i]["price"] = $fila["price"];
                    $row[$i]["stock"] = $fila["stock"];
                    $row[$i]["discount"] = $fila["discount"];
                    $row[$i]["code"] = $fila["code"];
                    $row[$i]["details"] = $fila["details"];
                    $row[$i]["image"] = $fila["image"];
                    $i++;
                }

                switch($filter){
                    case 0:
                        $row=mayor($row);
                        echo 'case 0';
                        break;
                    case 1:
                        $row=menor($row);
                        echo 'case 1';
                        break;
                    case 2:
                        $row=price1($row);
                        echo 'case 2';
                        break;
                    case 3:    
                        $row=price2($row);
                        echo 'case 3';
                        break;
                    case 4:    
                        $row=price3($row);
                        echo 'case 4';
                        break;
                    case 5:    
                        $row=price4($row);
                        echo 'case 5';
                        break;
                    case 6:    
                        $row=price5($row);
                        echo 'case 6';
                        break;
                    case 7:    
                        $row=price6($row);
                        echo 'case 7';
                        break;
                    case 8:    
                        $row=price7($row);
                        echo 'case 8';
                        break;
                    case 9:    
                        $row=price8($row);
                        echo 'case 9';
                        break;
                    case 10:    
                        $row=price9($row);
                        echo 'case 10';
                        break;
                    case 11:    
                        $row=price10($row);
                        echo 'case 11';
                        break;
                    case 12:    
                        $row=price11($row);
                        echo 'case 12';
                        break; 
                    case 13:    
                        $row=price12($row);
                        echo 'case 13';
                        break;                 
                    default:
                        break;    
                }

                $j=0;
                $n=(count($row))-1;
                while( $j <= $n){
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
            
        //Menor a Mayor 
        function menor ($row){ 
            usort($row, function($a, $b) {
                return $a['price'] - $b['price'];
            });
            return $row;
        }
        //Mayor a Menor
        function mayor ($row){
            usort($row, function($a, $b) {
                return $b['price'] - $a['price'];
            });
            return $row;
        }
        //0 a 50
        function price1 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if( $row[$i]['price'] <= 50){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //51 a 100
        function price2 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] > 50 & $row[$i]['price'] <= 100){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //101 a 200
        function price3 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] > 100 & $row[$i]['price'] <= 200){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //201 a 300
        function price4 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] > 200 & $row[$i]['price'] <= 300){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //301 a 400
        function price5 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] > 300 & $row[$i]['price'] <= 400){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //401 a 500
        function price6 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] > 400 & $row[$i]['price'] <= 500){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //501 a 600
        function price7 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] > 500 & $row[$i]['price'] <= 600){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //601 a 700
        function price8 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] > 600 & $row[$i]['price'] <= 700){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //701 a 800
        function price9 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] > 700 & $row[$i]['price'] <= 800){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //801 a 900
        function price10 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] > 800 & $row[$i]['price'] <= 900){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //901 a 1000
        function price11 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] > 900 & $row[$i]['price'] <= 1000){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        //1000 en adelante
        function price12 ($row){
            $sep = [];
            $i=0;
            $n=(count($row))-1;
            while( $i <= $n){ 
                if($row[$i]['price'] >= 1000){
                    array_push($sep, pass($sep,$row,$i));
                }
                $i++;
            }
            return $sep;
        }
        function pass( $a, $b ,$i){
            $a["id"] = $b[$i]["id"];
            $a["name"] = $b[$i]["name"];
            $a["category"] = $b[$i]["category"];
            $a["price"] = $b[$i]["price"];
            $a["stock"] = $b[$i]["stock"];
            $a["discount"] = $b[$i]["discount"];
            $a["code"] = $b[$i]["code"];
            $a["details"] = $b[$i]["details"];
            $a["image"] = $b[$i]["image"];
            return $a;
        }    
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