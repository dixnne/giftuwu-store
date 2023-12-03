<?php
    session_start();

    $category = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Acceder al valor enviado mediante POST
        if (isset($_POST['nueva_variable'])) {
            $nuevo_valor = $_POST['nueva_variable'];
    
            // Procesar el valor recibido (por ejemplo, actualizar la variable)
            // En este ejemplo, simplemente devolvemos el valor recibido como respuesta
            $category = $nuevo_valor;
        } else {
            echo "No se recibió ningún valor";
        }
    } else {
        echo "No se recibió una solicitud POST";
    }

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
                    switch ($category) {
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
                $res = [];
                $i=0;
                $resultado = $conexion -> query($sql);
                 if ($resultado -> num_rows){ 
                    while( $fila = $resultado -> fetch_assoc()){
                        array_push($res , $fila);
                    }
                    echo json_encode($res);
                 }
            }       
        ?>