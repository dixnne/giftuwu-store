<?php
    session_start();

    $category = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Acceder al valor enviado mediante POST
        if (isset($_POST['nueva_variable'])) {
            $nuevo_valor = $_POST['nueva_variable'];
            $category = $nuevo_valor;
        } else {
            echo "No se recibió ningún valor";
        }
    } else {
        echo "No se recibió una solicitud POST";
    }

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
                $query = 'SELECT * FROM  item WHERE category = '.$category.'';
                $resultado = $conexion -> query($query);
                $res = [];
                $i=0;
                $resultado = $conexion -> query($sql);
                if ($resultado -> num_rows){ 
                    while( $fila = $resultado -> fetch_assoc()){
                        array_push($res , $fila);
                    }
                    echo json_encode($res);
                }
                $conn->close();
            }       
?>