<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background : #485461;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .registration-form {
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #0056b3;
            text-decoration: none;
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

        input[type="text"], input[type="email"], input[type="password"] {
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

        .radio-group {
            margin-bottom: 20px;
        }

        .radio-label {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="registration-form">
        <h2>Register</h2>
        <form action="reg.php" method="POST">
            <label for="Login">Login (You can't change it later):</label>
            <input type="text" id="Login" name="Login" maxlength="15" required>

            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="FirstName" maxlength="25" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="LastName" maxlength="60" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="Email"  maxlength="40" required>

            <label for="password">Create a Password:</label>
            <input type="password" id="password" name="Passwd"   maxlength="60" required>

            <div class="radio-group">
                <span>Subscribe to Newsletter?</span>
                <label for="newsletterYes" class="radio-label">
                    <input type="radio" id="newsletterYes" name="NewsLetter" value="Yes"> Yes
                </label>
                <label for="newsletterNo" class="radio-label">
                    <input type="radio" id="newsletterNo" name="NewsLetter" value="No" required> No
                </label>
            </div>

            <input type="submit" id="register" name="register" value="Register">
            <a href="login.php">Already have an account? Login </a>
        </form>
    </div>
</body>
</html>
