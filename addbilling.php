<?php
session_start();
if (isset($_SESSION['ulogin'])) {
    $login = $_SESSION['ulogin'];
    echo "Logged in as " . $login;
} else {
    echo "Not logged in";
}
include('include/openDbconn.php');

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

    $sql = "INSERT INTO P2Billing (BillingID, login , BillName, BillAddress, BillCity, BillState, BillZip, CardType, CardNumber, ExpDate) 
    VALUES ('$billingID', '$login', '$Name', '$Address', '$City', '$State', '$Zip', '$cardType', '$cardNumber', '$expDate')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Billing Information</title>
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

    
    body{
        justify-content: center;
        background-color: #f8f9fa; 
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        align-items: center;
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
    <h2>Add Billing Information</h2>
    <form action="addbilling.php" method="post">
    Billing ID: <input type="text" pattern="\d{1,30}"  name="billingID" title="Enter only digits max length 30" required><br>
       
        Bill Name: <input type="text" maxlength="50" name="billName" required><br>
        Bill Address: <input type="text" maxlength="30" name="billAddress" required><br>
        Bill City: <input type="text"  maxlength="30"  name="billCity" required><br>
        Bill State: <input type="text"  maxlength="20"  name="billState" required><br>
        Bill Zip: <input type="text"  name="billZip"  pattern="\d{1,10}" title="Enter a 1-10 digit zip code" required><br>
        Card Type: <select name="cardType">
            <option value="Visa">Visa</option>
            <option value="MasterCard">MasterCard</option>
            <option value="Discover">Discover</option>
            <option value="American Express">American Express</option>
        </select><br>
         Card number: <input type="text" name="cardNumber" pattern="\d{16}" title="Enter 16 digits " required><br>
        Exp Date (MM/YY): <input type="text" name="expDate" pattern="(0[1-9]|1[0-2])\/\d{2}" title="Enter a date in the format MM/YY" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
