<?php
session_start();

if (!isset($_SESSION['ulogin'])) {
    header('Location: index.php');
    exit;
}
include('include/openDbconn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Shipping </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            padding: 20px;
            text-align: center;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: inline-block;
        }
        .upd {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: aqua;
            color: white;
            cursor: pointer;
        }
        .upd:hover {
            background-color: #ff0000;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<?php include 'smenu.php'; ?>

    <div class="container">
        <h1>Update Shipping Record</h1>
        <?php if(!empty($err)){
            echo "<p style='color:red;'>$err</p>";
        } ?>
        
        <form action="edit_shipping.php" method="get">
            <input type="text" name="shippingID" placeholder="Enter Shipping ID" required>
            <button type="submit" class="upd">Load Shipping Data</button>
        </form>
        </div>
    </div>
</body>
</html>
