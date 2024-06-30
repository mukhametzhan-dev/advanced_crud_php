<?php
session_start();
include('include/openDbconn.php');

if (!isset($_SESSION['ulogin'])) {
    header('Location: index.php');
    exit();
}

$login = $_SESSION['ulogin'];

if (isset($_POST['updateProfile'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $newsletter = $_POST['newsletter'];
    $password = $_POST['password']; 

    $sql = "UPDATE P2User SET FirstName='$firstName', LastName='$lastName', Passwd='$password', Email='$email', NewsLetter='$newsletter' WHERE Login='$login'";
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully.";
        header('Location: userprofile.php');
    } else {
        echo "No changes were made.";
    }
}

$conn->close();
?>