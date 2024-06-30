<?php
session_start();

include('include/openDbconn.php');
if (!isset($_SESSION['ulogin'])) {
    header('Location: index.php');
    exit;
}
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "main";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$usr = $_SESSION['ulogin'];
$sql = "SELECT BillingID, login, BillName, BillAddress, BillCity, BillState, BillZip, CardType, CardNumber, ExpDate FROM P2Billing WHERE login = '$usr'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $ships = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $ships = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Billing</title>
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
            margin: 0;
            padding: 20px;
        }

        .billing-table {
            width: 100%;
            border-collapse: collapse;
        }

        .billing-table th, .billing-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .billing-table th {
            background-color: #008CBA;
            color: white;
        }

        .billing-table tr:hover {background-color: #f5f5f5;}

        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<?php include 'menu.php'; ?>
    <div class="container">
        <h1>Billing Records</h1>
        <table class="billing-table">
            <thead>
                <tr>
                    <th>Billing ID</th>
                    <th>Login</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Card Type</th>
                    <th>Card Number</th>
                    <th>Exp Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ships)): ?>
                    <?php foreach ($ships as $sh): ?>
                        <tr>
                            <td><?= htmlspecialchars($sh['BillingID']) ?></td>
                            <td><?= htmlspecialchars($sh['login']) ?></td>
                            <td><?= htmlspecialchars($sh['BillName']) ?></td>
                            <td><?= htmlspecialchars($sh['BillAddress']) ?></td>
                            <td><?= htmlspecialchars($sh['BillCity']) ?></td>
                            <td><?= htmlspecialchars($sh['BillState']) ?></td>
                            <td><?= htmlspecialchars($sh['BillZip']) ?></td>
                            <td><?= htmlspecialchars($sh['CardType']) ?></td>
                            <td><?= htmlspecialchars($sh['CardNumber']) ?></td>
                            <td><?= htmlspecialchars($sh['ExpDate']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="10">No billing records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
