<?php
$servername = "localhost";
$username = "root";  
$password = "root";
$dbname = "main";  
// If we don't have database this php code will create it.
// optional  
// Eger sizde sql login nemese password baskasha bolsa include/openDbconn.php faylinda ozgertiniz )

$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully\n";


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

$conn->select_db($dbname);

$sqlUser = "CREATE TABLE IF NOT EXISTS P2User (
    Login VARCHAR(15) NOT NULL,
    FirstName VARCHAR(25) NOT NULL,
    LastName VARCHAR(60) NOT NULL,
    Passwd VARCHAR(60) NOT NULL,
    Email VARCHAR(40),
    NewsLetter VARCHAR(10),
    PRIMARY KEY (Login)
)";

$sqlShipping = "CREATE TABLE IF NOT EXISTS P2Shipping (
    ShippingID VARCHAR(30) NOT NULL,
    Login VARCHAR(15) NOT NULL,
    Name VARCHAR(50) NOT NULL,
    Address VARCHAR(30) NOT NULL,
    City VARCHAR(30) NOT NULL,
    State VARCHAR(20) NOT NULL,
    Zip VARCHAR(10) NOT NULL,
    PRIMARY KEY (ShippingID),
    FOREIGN KEY (Login) REFERENCES P2User(Login)
)";

$sqlBilling = "CREATE TABLE IF NOT EXISTS P2Billing (
    BillingID VARCHAR(30) NOT NULL,
    Login VARCHAR(15) NOT NULL,
    BillName VARCHAR(50) NOT NULL,
    BillAddress VARCHAR(30) NOT NULL,
    BillCity VARCHAR(30) NOT NULL,
    BillState VARCHAR(20) NOT NULL,
    BillZip VARCHAR(10) NOT NULL,
    CardType ENUM('Visa', 'MasterCard', 'Discover', 'American Express') NOT NULL,
    CardNumber VARCHAR(16) NOT NULL,
    ExpDate VARCHAR(5) NOT NULL,
    PRIMARY KEY (BillingID),
    FOREIGN KEY (Login) REFERENCES P2User(Login)
)";

if ($conn->query($sqlUser) === TRUE) {
    echo "Table P2User created successfully\n";
} else {
    echo "Error creating table P2User: " . $conn->error . "\n";
}

if ($conn->query($sqlShipping) === TRUE) {
    echo "Table P2Shipping created successfully\n";
} else {
    echo "Error creating table P2Shipping: " . $conn->error . "\n";
}

if ($conn->query($sqlBilling) === TRUE) {
    echo "Table P2Billing created successfully\n";
} else {
    echo "Error creating table P2Billing: " . $conn->error . "\n";
}

$conn->close();
?>
