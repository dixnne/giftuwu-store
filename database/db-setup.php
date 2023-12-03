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

$query = "CREATE DATABASE IF NOT EXISTS giftuwustore";
if ($conn->query($query) === FALSE) {
    echo "Error creating database: " . $conn->error . "<br>";
}

$conn->select_db($dbname);

$query = "CREATE TABLE IF NOT EXISTS item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(255) NOT NULL,
    category INT NOT NULL,
    price DECIMAL(5,2) NOT NULL,
    stock INT,
    discount DECIMAL(3,2),
    details TEXT,
    image VARCHAR(255)
)";

if ($conn->query($query) === FALSE) {
    echo "Error creating table item: " . $conn->error . "<br>";
}

$query = "CREATE TABLE IF NOT EXISTS category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    details TEXT
)";

if ($conn->query($query) === FALSE) {
    echo "Error creating table item: " . $conn->error . "<br>";
}

$query = "CREATE TABLE IF NOT EXISTS purchase (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client INT NOT NULL,
    cart VARCHAR(255) NOT NULL,
    purchaseDate DATE,
    state BOOLEAN,
    total DECIMAL(10,2) NOT NULL
)";

if ($conn->query($query) === FALSE) {
    echo "Error creating table purchase: " . $conn->error . "<br>";
}

$query = "CREATE TABLE IF NOT EXISTS coupon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(255) NOT NULL,
    details TEXT NOT NULL,
    discount DECIMAL(3,2),
    image VARCHAR(255) NOT NULL,
    general BOOLEAN,
    item INT
)";

if ($conn->query($query) === FALSE) {
    echo "Error creating table coupon: " . $conn->error . "<br>";
}

$query = "CREATE TABLE IF NOT EXISTS user (
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    blocked TINYINT
)";

if ($conn->query($query) === FALSE) {
    echo "Error creating table user: " . $conn->error . "<br>";
}

$query = "CREATE TABLE IF NOT EXISTS client (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    question VARCHAR(255) NOT NULL,
    answer VARCHAR(255) NOT NULL,
    currentPurchase INT,
    bday DATE
)";

if ($conn->query($query) === FALSE) {
    echo "Error creating table client: " . $conn->error . "<br>";
}

$query = "CREATE TABLE IF NOT EXISTS administrator (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL
)";

if ($conn->query($query) === FALSE) {
    echo "Error creating table administrator: " . $conn->error . "<br>";
}

$query = "CREATE TABLE IF NOT EXISTS store (
    name VARCHAR(255) NOT NULL PRIMARY KEY,
    details TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    profits INT
)";

if ($conn->query($query) === FALSE) {
    echo "Error creating table store: " . $conn->error . "<br>";
}

$query = "SELECT * FROM store";
$result = $conn->query($query);
if ($result->num_rows == 0) {
    $query = "INSERT INTO store (name, details, image) VALUES ('Gift uwu Store', 'Tienda de regalos en línea','')";
    if ($conn->query($query) === FALSE) {
        echo "Error inserting store data: " . $conn->error . "<br>";
    }
}

$query = "CREATE TABLE IF NOT EXISTS featured (
    id INT NOT NULL PRIMARY KEY,
    item INT
)";

if ($conn->query($query) === FALSE) {
    echo "Error creating table store: " . $conn->error . "<br>";
}

$conn->close();
?>