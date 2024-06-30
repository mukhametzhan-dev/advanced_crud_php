<?php
session_start();
if (isset($_SESSION['ulogin'])) {
    $login = $_SESSION['ulogin'];
    // echo "Logged in as " . $login;
} else {
    echo "Not logged in";
    exit(); 
}

include('include/openDbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $billingID = $_POST['shippingID'];
    $checkSql = "SELECT ShippingID FROM P2Shipping WHERE ShippingID = '$billingID'";
    $checkResult = $conn->query($checkSql);
    if ($checkResult->num_rows > 0) {
        echo "<script type='text/javascript'>displayErr();</script>";

    } 
    else{


    $sql = "INSERT INTO P2Shipping (ShippingID, Login, Name, Address, City, State, Zip) 
    VALUES ('$billingID', '$login', '$name', '$address', '$city', '$state', '$zip')";

    if ($conn->query($sql) === TRUE) {
        echo "\nNew shipping record created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Shipping Information</title>
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
            background-color: #f44336; 
        }

        #home {
            background-color: #008CBA; 
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
<script>
    displayErr()
</script>
</head>

<body>
<?php include 'smenu.php'; ?>
    <h2>Add Shipping Information</h2>
    <form action="addshipping.php" method="post">
    Shipping ID: <input type="text" name="shippingID" maxlength = "30" pattern="\d+" title="Enter only digits" required><br>
       
    Name: <input type="text" maxlength = "50" name="name" required><br>
    Address: <input type="text" maxlength = "30" name="address" required><br>
    City: <input type="text" maxlength = "30" name="city" required><br>
    State: <input type="text" maxlength = "20" name="state" required><br>
    Zip: <input type="text" name="zip" pattern="\d{5,10}" title="Enter a 5 to 10 digit zip code" required><br>
    <input type="submit" value="Submit">
    </form>
</body>
</html>
