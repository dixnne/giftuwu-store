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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->select_db($dbname);
   $query = "SELECT * FROM item";
   $result = $conn->query($query);
   if ($result -> num_rows > 0){
       
      $i=0;
      while( $row = $result -> fetch_assoc()){ 
          $fila[$i]["id"] = $row["id"];
          $fila[$i]["name"] = $row["name"];
          $fila[$i]["category"] = $row["category"];
          $fila[$i]["price"] = $row["price"];
          $fila[$i]["stock"] = $row["stock"];
          $fila[$i]["discount"] = $row["discount"];
          $fila[$i]["code"] = $row["code"];
          $fila[$i]["details"] = $row["details"];
          $fila[$i]["image"] = $row["image"];
          $i++;
      }
      switch($filter){
        case 0:
             $fila=mayor($fila);
            break;
        case 1:
         $fila=menor($fila);
            break;
        case 2:
         $fila=price1($fila);
            break;
        case 3:    
         $fila=price2($fila);
            break;
        case 4:    
         $fila=price3($fila);
            break;
        case 5:    
         $fila=price4($fila);
            break;
        case 6:    
         $fila=price5($fila);
            break;
        case 7:    
         $fila=price6($fila);
            break;
        case 8:    
         $fila=price7($fila);
            break;
        case 9:    
         $fila=price8($fila);
            break;
        case 10:    
         $fila=price9($fila);
            break;
        case 11:    
         $fila=price10($fila);
            break;
        case 12:    
         $fila=price11($fila);
            break; 
        case 13:    
         $fila=price12($fila);
            break;                 
        default:
            break;    
    }
    echo json_encode($fila);
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