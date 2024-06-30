<?php
session_start();
$loged = isset($_SESSION['ulogin']);

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
        <?php if($loged): ?>
        <div class="menu">

          <div class="hamburger-menu">

            <div class="bar"></div>
           
          </div>
        </div>
      </div>
      <?php endif; ?>

      <div class="main-container">
        <div class="main">
          <header>
            <div class="overlay">
              <div class="inner">
                <h2 class="title">Welcome to Aikorkem's project ! </h2>
                <?php echo $loged ? "Welcome, " . $_SESSION['ulogin'] : "You are not logged in"; ?>
                <p>
                    Start using our service by clicking menu button in left side 
                </p>
                <?php if(!$loged): ?>
                <button class="btn" onclick="window.location.href = 'login.php'">login </button>
                <button class="btn" onclick="window.location.href ='register.php'">sign-up</button>
                <?php endif; ?>
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
            <a href="#" style="--i: 0.05s;">Home</a>
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