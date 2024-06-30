<?php
session_start();


include('include/openDbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Login = $_POST["Login"];
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $email = $_POST["Email"];
    $passwd = $_POST["Passwd"];
    $newsletter = $_POST["NewsLetter"];

    $sql = "INSERT INTO P2User (Login ,FirstName, LastName, Email, Passwd, NewsLetter)
    VALUES ('$Login' , '$firstName', '$lastName', '$email', '$passwd', '$newsletter')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      $_SESSION['ulogin'] = $Login;
      header("Location: index.php");

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>