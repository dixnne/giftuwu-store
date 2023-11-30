<?php

function test_input($data) {
    $data = trim($data); 
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function getTableData($table){
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

    $query = "SELECT * FROM ".$table;
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function insertUser($user, $name, $email, $pswd, $image){
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

    $query = "INSERT INTO user (username, name, email, password, image) VALUES ('$user', '$name','$email', '$pswd', '$image')";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();
    return true;
}

function deleteUser($user){
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

    $query = "DELETE FROM user WHERE username='$user'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function modifyUser($user, $name, $email, $pswd, $image){
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

    $query = "UPDATE user SET username='$user', name='$name', email='$email', password='$pswd', image='$image' WHERE username='$user'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function insertClient($user, $name, $email, $pswd, $question, $answer, $image, $bday, $currentPurchase){
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

    $query = "INSERT INTO client (username, question, answer, currentPurchase, bday) VALUES ('$user', '$question','$answer', '$currentPurchase', '$bday')";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();
    if (insertUser($user, $name, $email, $pswd, $image)) {
        return true;
    }
    return false;
}

function deleteClient($id){
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

function modifyClient($user, $name, $email, $pswd, $question, $answer, $currentPurchase, $image, $bday){
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

    $query = "UPDATE client SET username='$user', question='$question', answer='$answer', currentPurchase='$currentPurchase', bday='$bday' WHERE username='$user'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
    modifyUser($user, $name, $email, $pswd, $image);
}

function insertItem($name, $code, $category, $price, $stock, $discount, $details, $image){
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

    $query = "INSERT INTO item (name, code, category, price, stock, discount, details, image) VALUES ('$name', '$code', '$category', '$price', '$stock', '$discount', '$details', '$image')";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();
    return true;
}

function deleteItem($id){
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

    $query = "DELETE FROM item WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function modifyItem($id, $name, $code, $category, $price, $stock, $discount, $details, $image){
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

    $query = "UPDATE item SET name='$name', code='$code', category='$category', price='$price', stock='$stock', discount='$discount', details='$details', image='$image' WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function insertCoupon($name, $code, $details, $discount, $image, $general, $item){
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

    $query = "INSERT INTO coupon (name, code, details, discount, image, general, item) VALUES ('$name', '$code', '$details', '$discount', '$image', '$general', '$item')";
    if ($conn->query($query) === FALSE) {
        echo "Error inserting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function deleteCoupon($id){
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

    $query = "DELETE FROM coupon WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        echo "Error deleting data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function modifyCoupon($id, $name, $code, $details, $discount, $image, $general, $item){
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

    $query = "UPDATE coupon SET name='$name', code='$code', details='$details', discount='$discount', image='$image', general='$general' WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        echo "Error modifying data: " . $conn->error . "<br>";
    }
    $conn->close();
}

function generatePurchase($client, $purchaseDate){
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

function getClient($key){
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

    $query = "SELECT * FROM client WHERE username='$key'";
    $result = $conn->query($query);
    $row = "";
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
    $conn->close();
    return $row;
}

function isAdmin($user){
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

    $query = "SELECT * FROM administrator WHERE username='$user'";
    $result = $conn->query($query);
    if ($result->num_rows > 0){
        $conn->close();
        return true;
    }else {
        $conn->close();
        return false;
    }
}

function isUser($user){
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

    $query = "SELECT * FROM user WHERE username='$user'";
    $result = $conn->query($query);
    if ($result->num_rows > 0){
        $conn->close();
        return true;
    }else {
        $conn->close();
        return false;
    }
}

function validateUser($user, $pswd){
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

    $query = "SELECT * FROM user WHERE username='$user'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if(password_verify($pswd, $row["password"])){
                $conn->close();
                return true;
            }
        }
    } 
    $conn->close();
    return false;
}
?>