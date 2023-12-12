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
    
    $username = "root"; 
    $password = "ch1d0N83"; 
    $dbname = "giftuwustore";
    $servername = "mysql_db_php_2"; //docker-compose.yml database name
    $port = 3306;  
    $conn = new mysqli($servername, $username, $password, '', $port);
    if ($conexion->connect_errno){
        die("Connection failed: " . $conn->connect_error);
   }else{
       
        $query = "SELECT * FROM item";
        $result = $conn->query($query);
        if ($result -> num_rows){
            
           $i=0;
           while( $fila = $result -> fetch_assoc()){ 
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
                   break;
               case 1:
                   $row=menor($row);
                   break;
               case 2:
                   $row=price1($row);
                   break;
               case 3:    
                   $row=price2($row);
                   break;
               case 4:    
                   $row=price3($row);
                   break;
               case 5:    
                   $row=price4($row);
                   break;
               case 6:    
                   $row=price5($row);
                   break;
               case 7:    
                   $row=price6($row);
                   break;
               case 8:    
                   $row=price7($row);
                   break;
               case 9:    
                   $row=price8($row);
                   break;
               case 10:    
                   $row=price9($row);
                   break;
               case 11:    
                   $row=price10($row);
                   break;
               case 12:    
                   $row=price11($row);
                   break; 
               case 13:    
                   $row=price12($row);
                   break;                 
               default:
                   break;    
           }
        }
        echo json_encode($row);
   } 
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