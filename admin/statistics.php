<?php
    session_start();
    require("../database/db-setup.php");
    require("../database/db-handle.php");
    if (isset($_SESSION["username"]) && isAdmin($_SESSION["username"])) {
        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin - Gift uwu Store</title>
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/styles.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body id="bootstrap-override" class="bg-color">
        <?php 
            require("../header/header-admin-login.php"); 
        ?>
    <div class="container text-center pt-3">
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
                    $cat1 = $cat2 = $cat3 = $cat4 = $cat5 = $cat6 = 0;
                    $pcat1 = $pcat2 = $pcat3 = $pcat4 = $pcat5 = $pcat6 = 0;
                    $conn->select_db($dbname); 
                    $query = "SELECT * FROM item WHERE category='1'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $cat1++;
                            $pcat1 += $row["price"];
                        }
                    }
                    $query = "SELECT * FROM item WHERE category='2'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $cat2++;
                            $pcat2 += $row["price"];
                        }
                    }
                    $query = "SELECT * FROM item WHERE category='3'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $cat3++;
                            $pcat3 += $row["price"];
                        }
                    }
                    $query = "SELECT * FROM item WHERE category='4'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $cat4++;
                            $pcat4 += $row["price"];
                        }
                    }
                    $query = "SELECT * FROM item WHERE category='5'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $cat5++;
                            $pcat5 += $row["price"];
                        }
                    }
                    $query = "SELECT * FROM item WHERE category='6'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $cat6++;
                            $pcat6 += $row["price"];
                        }
                    }
                    $pcat1 = $pcat1 / $cat1;
                    $pcat2 = $pcat2 / $cat2;
                    $pcat3 = $pcat3 / $cat3;
                    $pcat4 = $pcat4 / $cat4;
                    $pcat5 = $pcat5 / $cat5;
                    $pcat6 = $pcat6 / $cat6;
                    $conn->close();
                ?>
        <section class="px-5 py-3">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-center">Artículos por categoría</h3>
                    <canvas id="chart1"></canvas>
                </div>
                <div class="col-md-6">
                    <h3 class="text-center">Promedio en precios por categoría</h3>
                    <canvas id="chart2"></canvas>
                </div>
            </div>
        </section>
        </div>
        </div></div></div></section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="./statistics.js"></script>
        <script>createChart1(<?php echo $cat1.', '.$cat2.', '.$cat3.', '.$cat4.', '.$cat5.', '.$cat6 ?>);</script>
        <script>createChart2(<?php echo $pcat1.', '.$pcat2.', '.$pcat3.', '.$pcat4.', '.$pcat5.', '.$pcat6 ?>);</script>
    </body>
</html>
<?php
    } else {
        header("Location: ./index.php");
    }
    
?>