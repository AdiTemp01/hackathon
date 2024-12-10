<?php
include 'includes/db.php';
include 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($pdo, $username, $password)) {
        header('Location: home.php');
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            overflow: hidden;
            animation: backgroundAnimation 10s infinite alternate;
        }

        @keyframes backgroundAnimation {
            0% { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); }
            50% { background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); }
            100% { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); }
        }

        /* Login Form */
        .login-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px 60px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
        }

        .login-container p {
            text-align: center;
            font-size: 1rem;
            margin: 20px 0;
            color: #d4d4d4;
        }

        .login-container a {
            color: #ffd700;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-container a:hover {
            color: #fff;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: #fff;
            color: #333;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        input:focus {
            background-color: #e0f7fa;
            box-shadow: 0 0 5px #64b5f6;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2575fc;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #6a11cb;
            transform: scale(1.05);
        }

        .error {
            color: #ff6a00;
            text-align: center;
            font-size: 1rem;
            margin-bottom: 20px;
            animation: errorAnimation 1.5s ease-out;
        }

        @keyframes errorAnimation {
            0% { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Mobile responsiveness */
        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>

        <!-- Show error message if there is one -->
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
