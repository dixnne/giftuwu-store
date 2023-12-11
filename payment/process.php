<?php
session_start();
require("../database/db-setup.php");
require("../database/db-handle.php");
if (!isset($_SESSION["username"])) {
    header("Location: ../session/login.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["items"]) && is_array($_POST["items"])) {
        $checkedItems = $_POST["items"];
        $quantity = $_POST["quantity"];
        $i = $q = 0;
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
                        if ($itemid == $checkedItems[$i]) {
                            $itemQuantity = test_input($quantity[$q]);
                            if ($row["quantity"] != $itemQuantity) {
                                deleteCartItem($_SESSION["username"], $itemid);
                                addCartItem($_SESSION["username"], $itemid, $itemQuantity);
                            }
                            $i++;
                        } else {
                            deleteCartItem($_SESSION["username"], $itemid);
                        }
                        $q++;
                    }
                }
            }
        }
    }
}
header("Location: ./method_payment.php");
?>