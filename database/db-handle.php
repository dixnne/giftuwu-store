<?php

$conn->close();

function connectDB(){
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
    return $conn;
}
function getTableData($table){
    $conn = connectDB();
    $query = "SELECT * FROM ".$table;
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function insertUser($username, $name, $email, $password){
    $conn = connectDB();
    $query = "INSERT INTO user (username, name, email, password) VALUES ('$username', '$name','$email', '$password')";
    if ($conn->query($query) === FALSE) {
        echo "Error inserting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function deleteUser($user){
    $conn = connectDB();
    $query = "DELETE FROM user WHERE id='$user'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}
?>