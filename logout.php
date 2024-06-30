
<?php
session_start();

if (isset($_SESSION['ulogin'])) {
    unset($_SESSION['ulogin']);


    session_destroy();
}

header('Location: index.php');
exit;
?>
