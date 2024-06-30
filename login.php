<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            /* background: #f4f4f9; */
            background : #485461;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-form {
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            color: #666;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #004494;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #0056b3;
            text-decoration: none;
        }
        .erlab{
            color: red;
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <?php
if (isset($_GET['error'])) {
    echo "<label class = 'erlab' >Either login or password is incorrect</label>";
}
?>
        <form action="log.php" method="post">
            <label for="Login">Username:</label>
            <input type="text" id="Login"  maxlength="15" name="Login">
            <label for="Passwd">Password:</label>
            <input type="password" id="Passwd"  maxlength="60" name="Passwd">
            <input type="submit" id="loginb" name="loginb" value="Log In">
        </form>
        <a href="register.php">Don't have an account? Register</a>
    </div>
</body>
</html>
