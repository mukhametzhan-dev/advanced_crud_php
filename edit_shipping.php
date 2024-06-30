<?php
session_start();

if (!isset($_SESSION['ulogin'])) {
    header('Location: index.php');
    exit;
}
$usr = $_SESSION['ulogin'];
include('include/openDbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['shippingID'])) {
    $billingID = $_GET['shippingID'];
    $sql = "SELECT * FROM P2Shipping WHERE ShippingID = '$billingID' AND Login = '$usr'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $billingID = $_POST['shippingID'];
    $Name = $_POST['Name'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $Zip = $_POST['Zip'];

    $sql = "UPDATE P2Shipping SET Name = '$Name', Address = '$Address', City = '$City', State = '$State', Zip = '$Zip' WHERE ShippingID = '$billingID' AND Login = '$usr'";

    if ($conn->query($sql) === TRUE) {
        $mes = "Record updated successfully";
    } else {
        $mes = "Error: ID not found";
        echo "Error: ID not found " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shipping</title>
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
<?php include 'smenu.php'; ?>

    <br>
<?php if (isset($data)): ?>
    <form action="edit_shipping.php" method="post">

        <input type="hidden" name="shippingID" value="<?php echo $data['ShippingID']; ?>">

        <label>Name: </label>
         <input type="text" name="Name" maxlength="50" value = <?php echo $data['Name']; ?> 
        <label> Address: </label>
            <input type="text" name="Address" maxlength="30" value = <?php echo $data['Address']; ?>
        <label> City: </label>

            <input type="text" name="City"  maxlength="30" value = <?php echo $data['City']; ?>
        <label>State: </label>

            <input type="text" name="State" maxlength="20" value = <?php echo $data['State']; ?>
        <label>Zip: </label>
            <input type="text" name = "Zip" pattern="\d{5,10}" title="Enter a 5-10 digit zip code" required value = <?php echo $data['Zip']; ?>>
            <!-- <input type="text" name="billZip" value = <?php echo $data['Zip']; ?> -->
        <br>   

        <br>


        <input type="submit" value="Update Shipping">
    </form>
    <?php elseif ($_SERVER["REQUEST_METHOD"] != "POST"): ?>
    <div id="error-msg">Shipping with ID <?= $billingID ?> not found</div>
<?php endif; ?>
<?php if (isset($mes)): ?>
    <div id="success-message">Shipping with ID <?= $billingID ?> updated successfully</div>
<?php endif; ?>
<script>
    setTimeout(function() {
        var element = document.getElementById('success-message');
        if (element) {
            element.style.opacity = "0";
        }
    }, 3000);

    setTimeout(function() {
        var element = document.getElementById('error-msg');
        if (element) {
            element.style.opacity = "0";
        }
    }, 3000);
</script>

</body>
</html>

