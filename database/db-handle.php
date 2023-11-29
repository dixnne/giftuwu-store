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
    $query = "DELETE FROM user WHERE username='$user'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function modifyUser($username, $name, $email, $password){
    $conn = connectDB();
    $query = "UPDATE user SET username='$username', name='$name', email='$email', password='$password' WHERE username='$username'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function insertClient($username, $name, $email, $password, $question, $answer){
    $conn = connectDB();
    $query = "INSERT INTO client (username, question, answer, currentPurchase) VALUES ('$username', '$question','$answer', '1')";
    if ($conn->query($query) === FALSE) {
        echo "Error inserting data: " . $conn->error . "<br>";
    }
    $conn->close();
    insertUser($username, $name, $email, $password);
}

function deleteClient($id){
    $conn = connectDB();
    $query = "SELECT * FROM client WHERE id='$id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $user = $row["username"];
        }
    }
    $query = "DELETE FROM client WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
    deleteUser($user);
}

function modifyClient($username, $name, $email, $password, $question, $answer, $currentPurchase){
    $conn = connectDB();
    $query = "UPDATE client SET username='$username', question='$question', answer='$answer', currentPurchase='$currentPurchase' WHERE username='$username'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
    modifyUser($username, $name, $email, $password);
}

function insertItem($name, $code, $category, $price, $stock, $discount, $details, $image){
    $conn = connectDB();
    $query = "INSERT INTO item (name, code, category, price, stock, discount, details, image) VALUES ('$name', '$code', '$category', '$price', '$stock', '$discount', '$details', '$image')";
    if ($conn->query($query) === FALSE) {
        echo "Error inserting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function deleteItem($id){
    $conn = connectDB();
    $query = "DELETE FROM item WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function modifyItem($id, $name, $code, $category, $price, $stock, $discount, $details, $image){
    $conn = connectDB();
    $query = "UPDATE item SET name='$name', code='$code', category='$category', price='$price', stock='$stock', discount='$discount', details='$details', image='$image' WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function insertCoupon($name, $code, $details, $discount, $image, $general, $item){
    $conn = connectDB();
    $query = "INSERT INTO coupon (name, code, details, discount, image, general, item) VALUES ('$name', '$code', '$details', '$discount', '$image', '$general', '$item')";
    if ($conn->query($query) === FALSE) {
        echo "Error inserting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function deleteCoupon($id){
    $conn = connectDB();
    $query = "DELETE FROM coupon WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function modifyCoupon($id, $name, $code, $details, $discount, $image, $general, $item){
    $conn = connectDB();
    $query = "UPDATE coupon SET name='$name', code='$code', details='$details', discount='$discount', image='$image', general='$general' WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        echo "Error modifying data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function generatePurchase($client, $purchaseDate){
    $conn = connectDB();
    $query = "SELECT * FROM client WHERE id='$client'";
    $result = $conn->query($query);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $currentPurchase = $row["currentPurchase"];
        }
    }
    $cartname = "cart".$client."_".$currentPurchase;
    $query = "CREATE TABLE IF NOT EXISTS $cartname(
        id INT AUTO_INCREMENT PRIMARY KEY,
        item INT NOT NULL,
        quantity VARCHAR(255) NOT NULL,
        profits INT
    )";
    if ($conn->query($query) === FALSE) {
        echo "Error creating table cart: " . $conn->error . "<br>";
    }
    $query = "INSERT INTO purchase (client, cart, purchaseDate, state, total) VALUES ('$client', '$cartname', '$purchaseDate', '1', '0')";
    if ($conn->query($query) === FALSE) {
        echo "Error creating table cart: " . $conn->error . "<br>";
    }
    $conn->close();
}

function getRow($table, $keyname, $key){
    $conn = connectDB();
    $query = "SELECT * FROM '$table' WHERE '$keyname'='$key'";
    $result = $conn->query($query);
    $row = "";
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
    return $row;
}
?>