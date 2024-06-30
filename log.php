<?php
session_start();

if(isset($_POST['loginb'])){ 
    $ulogin = $_POST['Login']; 
    $upass = $_POST['Passwd']; 

$host = "localhost"; 
$username = "root"; 
$password = "root"; 
$dbname = "main"; 
$con = mysqli_connect($host, $username, $password, $dbname); 
$zapros = "SELECT * FROM P2User WHERE Login ='$ulogin' AND Passwd ='$upass' "; 
$rezultat =  mysqli_query($con, $zapros); 
$rowcount = mysqli_num_rows($rezultat); 
if($rowcount>0) { 
    $_SESSION['ulogin'] = $ulogin;
    header("Location: index.php");
    exit();
} else { 
    header("Location: login.php?error=1");
   // echo "Either login or password is incorrect"; 
    exit();
} }
?>
