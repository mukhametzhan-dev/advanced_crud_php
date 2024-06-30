<?php
session_start();

if (!isset($_SESSION['ulogin'])) {
    header('Location: index.php');
    exit;
}
$usr = $_SESSION['ulogin'];
include('include/openDbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['billingID']) ) {
    $billingID = $_GET['billingID'];
    $sql = "SELECT * FROM P2Billing WHERE BillingID = '$billingID' AND login = '$usr'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $billingID = $_POST['billingID'];
    $Name = $_POST['billName'];
    $Address = $_POST['billAddress'];
    $City = $_POST['billCity'];
    $State = $_POST['billState'];
    $Zip = $_POST['billZip'];
    $cardType = $_POST['cardType'];
    $cardNumber = $_POST['cardNumber'];
    $expDate = $_POST['expDate'];


    $sql = "UPDATE P2Billing SET BillName = '$Name', BillAddress = '$Address', BillCity = '$City', BillState = '$State', BillZip = '$Zip', CardType = '$cardType', CardNumber = '$cardNumber', ExpDate = '$expDate' WHERE BillingID = '$billingID'";
    if ($conn->query($sql) === TRUE) {
        $mes = "Record updated successfully";
    } else {
        $mes = "Error: ID not found";
        echo "Error: id not found " . $sql . "<br>" . $conn->error;
       


    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Billing - Saynura's Management System</title>
    <style>


          .button-bar {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .error-message {
            color: red;
            font-size: 16px;
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
        #view,#update
        {
            background-color: #008CBA;
        }
        #view:hover, #update:hover
        {
            background-color: #008CBA;
            box-shadow: 0 0 5px #ff0000;
        }

    
    body{
        justify-content: center;
        background-color: #f8f9fa; 
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        align-items: center;
    }
    #success-message {
            color: green;
            padding: 10px;
            border: 1px solid green;
            border-radius: 5px;
            transition: opacity 1s ease-in-out;
        }
    #error-msg{
        color:red;
        padding: 10px;
        border: 1px solid red;
            border-radius: 5px;
            transition: opacity 1s ease-in-out;
    }
    form {
  max-width: fit-content;
  margin-left: auto;
  flex-direction: column;
        padding: 20px;
  margin-right: auto;
  gap: 15px;
  
}
input[type="text"], select {
    width: 100%; 
    padding: 10px; 
    margin: 5px 0 15px 0; 
    display: inline-block; 
    border: 1px solid #ccc; 
    box-sizing: border-box; 
    border-radius: 5px; 
    font-size: 16px; 
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}

    ::after  p {
              background-color: #ffffff; 
              padding: 10px; 
              font-size: 16px; 
              line-height: 1.0; 
              color: #333333; 
              font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            }
    input[type="submit"] {
  background-color: #007bff; 
  color: #fff; 
  border: none; 
  padding: 10px 20px; 
  font-size: 16px; 
  cursor: pointer; 
  border-radius: 5px; 
  transition: all 1s ease; 
            }

input[type="submit"]:hover {
  background-color: #0056b3; 
  box-shadow: 0 0 5px #ff0000; 
  
}
    </style>
</head>
<body>
<?php include 'menu.php'; ?>

    <br>
<?php if (isset($data)): ?>
    <form action="edit_billing.php" method="post">

        <input type="hidden" name="billingID" pattern="\d{1,30}"  value="<?php echo $data['BillingID']; ?>">
       
        <label>Bill Name: </label>
         <input type="text" name="billName"  maxlength="50"  value = <?php echo $data['BillName']; ?> 
        <label> Bill Address: </label>
            <input type="text" name="billAddress" value = <?php echo $data['BillAddress']; ?>
        <label> Bill City: </label>

            <input type="text" name="billCity"  maxlength="30"  value = <?php echo $data['BillCity']; ?>
        <label>Bill State: </label>

            <input type="text" name="billState" maxlength="20" value = <?php echo $data['BillState']; ?>
        <label>Bill Zip: </label>
            <input type="text" name = "billZip" pattern="\d{1,10}" title="Enter a 1-10 digit zip code" required value = <?php echo $data['BillZip']; ?>>
            <!-- <input type="text" name="billZip" value = <?php echo $data['BillZip']; ?> -->
        <br>   
        <label>Card Type: </label>
            <select name="cardType">
                <option value="Visa" <?php if ($data['CardType'] == 'Visa') echo 'selected'; ?>>Visa</option>
                <option value="MasterCard" <?php if ($data['CardType'] == 'MasterCard') echo 'selected'; ?>>MasterCard</option>
                <option value="Discover" <?php if ($data['CardType'] == 'Discover') echo 'selected'; ?>>Discover</option>
                <option value="American Express" <?php if ($data['CardType'] == 'American Express') echo 'selected'; ?>>American Express</option>
            </select>
        <label>Card Number: </label>
        <input type="text" name = "cardNumber" pattern="\d{16}" title="Enter a 16 digit card number" required value = <?php echo $data['CardNumber']; ?>>
        <!--    <input type="text" name="cardNumber" value = <?php echo $data['CardNumber']; ?> -->
            <br>
        <label>Exp Date (MM/YY): </label>
        <input type="text" name="expDate" pattern="(0[1-9]|1[0-2])\/\d{2}" title="Enter a date in the format MM/YY" required  value = <?php echo $data['ExpDate']; ?>><br>
           <!-- / <input type="text" name="expDate" -->
        <br>


        <input type="submit" value="Update Billing">
    </form>
    <?php elseif ($_SERVER["REQUEST_METHOD"] != "POST"): ?>
    <div id="error-msg">Billing with ID <?= $billingID ?> not found</div>
<?php endif; ?>
<?php if (isset($mes)): ?>
    <div id="success-message">Billing with ID <?= $billingID ?> updated successfully</div>
<?php endif; ?>
<script>
        setTimeout(function() {
            var element = document.getElementById('success-message');
         element.style.opacity = "0";

        }, 3000);
        setTimeout(function() {
            var element = document.getElementById('error-msg');
           element.style.opacity = "0";

        }, 3000);
    

    </script>
</body>
</html>

