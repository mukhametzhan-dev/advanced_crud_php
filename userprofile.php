<?php

session_start();
include('include/openDbconn.php');
if (!isset($_SESSION['ulogin'])) {
    header('Location: index.php');
    exit();
}

$login = $_SESSION['ulogin'];
$sql = "SELECT Login, FirstName, LastName, Passwd, Email, NewsLetter FROM P2User WHERE Login = '$login'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found.";
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <div class="navbar">

        <div class="menu">

          <div class="hamburger-menu">
            

            <div class="bar"></div>
            
           
          </div>
          
        </div>
        
      </div>
      <h1 style="margin-left: 200px"> User Profile</h1>


      <div class="main-container">
        <div class="main">
          <header>
            <div class="overlay">
              <div id="ozgertu" class="inner" >
              
    <p>Login: <?php echo htmlspecialchars($user['Login']); ?></p>
    <br>
    <p>First Name: <?php echo htmlspecialchars($user['FirstName']); ?></p>
    <br>
    <p>Last Name: <?php echo htmlspecialchars($user['LastName']); ?></p>
    <br>
    <p>Email: <?php echo htmlspecialchars($user['Email']); ?></p>
    <br>
    <p>Newsletter Subscription: <?php echo htmlspecialchars($user['NewsLetter']); ?></p>
    <br>
    <p>Password: <span id="password" style="display:none;"><?php echo htmlspecialchars($user['Passwd']); ?></span>
        <button id="toggleButton" onclick="togglePasswordVisibility()">Show</button>
    </p>

    <br>
    <button class="btn" onclick="editProfile()" >Edit</button>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var tg = document.getElementById('toggleButton');
            if (passwordField.style.display === 'none') {
                passwordField.style.display = 'inline';
                tg.textContent = 'hide';
            } else {
                tg.textContent = 'show';
                passwordField.style.display = 'none';
            }
        }
        function editProfile() {
        document.getElementById('ozgertu').innerHTML = `
            <form action="user_update.php" method="post">
               <p> <label for="firstName">First Name:</label>
                <input type="text" id="firstName" maxlength = "25" name="firstName" value="<?php echo htmlspecialchars($user['FirstName']); ?>" required> </p><br>
            <p>
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" maxlength = "60" name="lastName" value="<?php echo htmlspecialchars($user['LastName']); ?>" required> </p><br>

            <p>    <label for="email">Email:</label>
                <input type="email" maxlength = "40" id="email" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required> </p><br>

            <p>    <label for="newsletter">Newsletter Subscription:</label>
                <select id="newsletter" name="newsletter">
                    <option value="Yes" <?php echo ($user['NewsLetter'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo ($user['NewsLetter'] == 'No') ? 'selected' : ''; ?>>No</option>
                </select> </p>
                <br>
                <br>

            <p>    <label for="password">Password:</label>
                <input type="password" maxlength = "60" id="password" name="password" value="<?php echo htmlspecialchars($user['Passwd']); ?>" required>
            </p>
            <br>
                <button class = "btn" type="submit" name="updateProfile">Save</button>
            </form>
        `;
    }
    </script>
              </div>
            </div>
          </header>
        </div>

        <div class="shadow one"></div>
        <div class="shadow two"></div>
      </div>

      <div class="links">
        <ul>
          <li>
            <a href="index.php" style="--i: 0.05s;">Home</a>
          </li>
          

            <a href="addbilling.php" style="--i: 0.1s;">Billing</a>

          </li>
          <li>
            <a href="addshipping.php" style="--i: 0.15s;">Shipping</a>
          </li>
          <li>
            <a href="userprofile.php" style="--i: 0.2s;">User profile</a>
          </li>
          <li>
            <a href="logout.php" style="--i: 0.25s;">Log out</a>
          </li>

        </ul>
      </div>
    </div>

    <script src="script.js"></script>
  </body>
</html>