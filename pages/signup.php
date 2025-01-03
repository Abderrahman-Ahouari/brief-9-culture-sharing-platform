<?php
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
      $first_name = $_POST['first-name'];
      $last_name = $_POST['last-name'];
      $email = $_POST['email'];
      $phone = $_POST['phone']; 
      $role = $_POST['role'];
      $password = $_POST['password'];
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <style>
        :root {
            --copper: #B87333;
            --dark-gray: #333;
            --coral: #FF7F50;
            --white: #fff;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: var(--dark-gray);
            color: var(--white);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: var(--white);
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }

        .container h1 {
            color: var(--dark-gray);
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark-gray);
        }

        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--copper);
            border-radius: 20px;
            box-sizing: border-box;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            margin-top: 1rem;
            border: none;
            border-radius: 20px;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-signup {
            background-color: var(--coral);
            color: var(--white);
        }

        .btn-login {
            background-color: var(--dark-gray);
            color: var(--white);
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background-color: var(--copper);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }

            .btn {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Signup</h1>
        <form method="POST">
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" name="first-name" required>
            </div>

            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last-name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" id="role" name="role" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-signup">Signup</button>
        </form>
        <a href="login.html" class="btn btn-login">Already have an account? Login</a>
    </div>
</body>
</html>
