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

    $blocked = 0;
    $query = "INSERT INTO user (username, name, email, password, image, blocked) VALUES ('$user', '$name','$email', '$pswd', '$image', '$blocked')";
    if ($conn->query($query) === FALSE) {
        echo "Error inserting user data: " . $conn->error . "<br>";
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
        echo "Error inserting client data: " . $conn->error . "<br>";
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
        echo "Error inserting data: " . $conn->error . "<br>";
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
        return false;
    }
    $conn->close();
    return true;
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
        return false;
    }
    $conn->close();
    return true;
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
        return false;
    }
    $conn->close();
    return true;
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
        return false;
    }
    $conn->close();
    return true;
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

    $query = "UPDATE coupon SET name='$name', code='$code', details='$details', discount='$discount', image='$image', general='$general', item='$item' WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();
    return true;
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

function getUser($key){
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

    $query = "SELECT * FROM user WHERE username='$key'";
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

function updtatePassword($user, $pswd){
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

    $query = "UPDATE user SET password='$pswd' WHERE username='$user'";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();

    return true;
}

function denyUser($user){
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

    $blocked = 1;
    $query = "UPDATE user SET blocked='$blocked' WHERE username='$user'";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();

    return true;
}

function allowUser($user){
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

    $blocked = 0;
    $query = "UPDATE user SET blocked='$blocked' WHERE username='$user'";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();

    return true;
}

function isAllowed($user){
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
        while ($row = $result->fetch_assoc()) {
            if ($row["blocked"] == 1) {
                $conn->close();
                return false;
            } else {
                $conn->close();
                return true;
            }
        }
    }else {
        $conn->close();
        return false;
    }
}

function getItemsCount(){
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
    return mysqli_num_rows($result);
}

function insertFeatured($id, $item){
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

    $query = "INSERT INTO featured (id, item) VALUES ('$id', '$item')";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();
    return true;
}

function deleteFeatured($id){
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

    $query = "DELETE FROM featured WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();
    return true;
}

function setFeatured($id, $item){
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

    $query = "UPDATE featured SET item='$item' WHERE id='$id'";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();
    return true;
}

function getFeatured($id){
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

    $query = "SELECT * FROM featured WHERE id='$id'";
    $result = $conn->query($query);
    $row = "";
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
    $conn->close();
    return $row;
}

function getItem($id){
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

    $query = "SELECT * FROM item WHERE id='$id'";
    $result = $conn->query($query);
    $row = "";
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
    $conn->close();
    return $row;
}

function addCartItem($user, $item, $quantity){
    $username = "root"; 
    $password = "ch1d0N83"; 
    $dbname = "giftuwustore";
    $servername = "mysql_db_php_2"; //docker-compose.yml database name
    $port = 3306;  
    $conn = new mysqli($servername, $username, $password, '', $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    date_default_timezone_set('America/Los_Angeles');
    $addedDate = date('Y-m-d', time());

    $conn->select_db($dbname);

    $query = "SELECT * FROM cart WHERE user='$user' AND item='$item'";
    $result = $conn->query($query);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            $quantity = $quantity + $row["quantity"];
            $query = "UPDATE cart SET quantity='$quantity' WHERE user='$user' AND item='$item'";
            if ($conn->query($query) === FALSE) {
                return false;
            }
            $conn->close();
            return true;
        }
    } else {
        $query = "INSERT INTO cart (user, item, addedDate, quantity) VALUES ('$user', '$item', '$addedDate', '$quantity')";
        if ($conn->query($query) === FALSE) {
            return false;
        }
        $conn->close();
        return true;       
    }
}

function deleteCartItem($user, $item){
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

    $query = "DELETE FROM cart WHERE user='$user' AND item='$item'";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();
    return true;
}

function getCart($user){
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

    $query = "SELECT * FROM cart WHERE user='$user'";
    $result = $conn->query($query);
    if ($result->num_rows > 0){
        return $result;
    }
    return "";
}

function getCartCount($user){
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

    $query = "SELECT * FROM cart WHERE user='$user'";
    $result = $conn->query($query);
    return mysqli_num_rows($result);
}

function generatePurchase($user, $items, $total){
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

    date_default_timezone_set('America/Los_Angeles');
    $purchaseDate = date('Y-m-d', time());
    $query = "DELETE FROM cart WHERE user='$user'";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $query = "INSERT INTO purchase (user, purchaseDate, items, total) VALUES ('$user', '$purchaseDate', '$items', '$total')";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $query = "SELECT * FROM store WHERE name='Gift uwu Store'";
    $result = $conn->query($query);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            $profits = $row["profits"] + $total;
        }
    }
    $query = "UPDATE store SET profits='$profits' WHERE name='Gift uwu Store'";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $query = "INSERT INTO purchase (user, purchaseDate, items, total) VALUES ('$user', '$purchaseDate', '$items', '$total')";
    if ($conn->query($query) === FALSE) {
        return false;
    }
    $conn->close();
    return true; 
}
?>