<?php
include 'includes/db.php';
include 'includes/auth.php';
session_start();

// Check if the user is logged in
if (!isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Check if the quiz is completed and passed
if (!isset($_SESSION['quiz_complete']) || $_SESSION['quiz_complete'] !== true || $_SESSION['quiz_score'] < 7) {
    header('Location: thank_you.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $github_link = $_POST['github_link'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare('INSERT INTO submissions (user_id, github_link) VALUES (?, ?)');
    $stmt->execute([$user_id, $github_link]);

    header('Location: success.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti"></script> <!-- Confetti JS -->
    <title>Submit Your Code</title>
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
            background: #ff6a00;
            background: linear-gradient(45deg, #ff6a00, #f7b731, #ff6348, #ff1e56, #8e44ad);
            background-size: 400% 400%;
            animation: gradientBackground 8s ease infinite;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
        }

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        h1 {
            font-size: 3rem;
            color: white;
            font-weight: bold;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
            animation: textEnter 2s ease-out;
            margin-bottom: 30px;
        }

        @keyframes textEnter {
            0% { transform: translateY(-50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        form {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 600px;
            animation: formEnter 2s ease-out;
        }

        @keyframes formEnter {
            0% { transform: translateY(100px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        label {
            font-size: 1.2rem;
            margin-bottom: 10px;
            display: block;
            color: #fff;
        }

        input[type="url"] {
            padding: 10px;
            font-size: 1rem;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            outline: none;
            background-color: #f39c12;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: 0.3s ease;
        }

        input[type="url"]:focus {
            background-color: #f1c40f;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        button {
            padding: 12px 25px;
            font-size: 1.2rem;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        button:hover {
            background-color: #c0392b;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
        }

        /* Confetti Style */
        .confetti {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }

            form {
                padding: 20px;
            }

            input[type="url"] {
                font-size: 0.9rem;
            }

            button {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="confetti" id="confetti"></div>
    <div>
        <h1>Submit Your GitHub Link</h1>
        <form method="POST">
            <label for="github_link">GitHub URL:</label>
            <input type="url" name="github_link" id="github_link" required placeholder="Enter your GitHub link here">
            <button type="submit">Submit</button>
        </form>
    </div>
    <script>
        // Confetti animation on page load
        const confetti = document.getElementById("confetti");

        function createConfetti() {
            confetti && confetti.confetti({
                particleCount: 200,
                spread: 70,
                origin: { y: 0.6 }
            });
        }

        // Trigger confetti animation when the page loads
        window.onload = createConfetti;
    </script>
</body>
</html>
