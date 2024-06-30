<?php
session_start();

if (!isset($_SESSION['ulogin'])) {
    header('Location: index.php');
    exit;
}
include('include/openDbconn.php');
$usr = $_SESSION['ulogin'];

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['shippingID'])) {
    $billingID = $_POST['shippingID'];

    $sql = "DELETE FROM P2Shipping WHERE ShippingID = $billingID AND login = '$usr'";
    $result = $conn->query($sql);

    if ($conn->affected_rows > 0) {
        $errorMessage = "Record deleted successfully.";
    } else {
        $errorMessage = "Error: ID not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Billing Record</title>
    <style>
              .button-bar {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        #add {
            background-color: #4CAF50;
        }

        #delete {
            background-color: #f44336; /* R
        }

        #update {
            background-color: #FFD700; /* Yellow */
        }

        #home {
            background-color: #008CBA; /* Blue */
        }
        .button {
            width: 150px;
            height: 50px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }
        #view
        {
            background-color: #008CBA;
        }
        #view:hover
        {
            background-color: #008CBA;
            box-shadow: 0 0 5px #ff0000;
        }

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

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        .input-group input {
            width: calc(100% - 22px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .button-del {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #f44336;
            color: white;
            cursor: pointer;
        }

        .error-message {
            color: red;
            font-size: 16px;
        }
    </style>
</head>
<body>
<?php include 'smenu.php'; ?>
    <div class="container">
        <h2>Delete Shipping Record</h2>
        <?php if ($errorMessage): ?>
            <p class="error-message"><?= $errorMessage ?></p>
        <?php endif; ?>
        <form action="delete_shipping.php" method="post">
            <div class="input-group">
                <label for="shippingID">Shipping ID to delete:</label>
                <input type="number" id="shippingID" name="shippingID" required>
            </div>
            <button type="submit" class="button-del">Delete</button>
        </form>
    </div>
</body>
</html>
