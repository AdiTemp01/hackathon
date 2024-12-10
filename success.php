<?php
include 'includes/auth.php';

if (!isLoggedIn()) {
    header('Location: index.php');
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
    <title>Submission Successful</title>
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
            background: #00bfff;
            background: linear-gradient(45deg, #00bfff, #ff6347, #ff6a00, #f7b731);
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
            text-shadow: 2px 2px 15px rgba(0, 0, 0, 0.6);
            animation: textEnter 2s ease-out;
            margin-bottom: 30px;
        }

        @keyframes textEnter {
            0% { transform: translateY(-50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        p {
            font-size: 1.5rem;
            margin-bottom: 20px;
            animation: textEnter 2s ease-out;
        }

        a {
            font-size: 1.2rem;
            color: #fff;
            text-decoration: none;
            padding: 12px 25px;
            background-color: #f39c12;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: 0.3s ease;
        }

        a:hover {
            background-color: #f1c40f;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-3px);
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

            p {
                font-size: 1.2rem;
            }

            a {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="confetti" id="confetti"></div>
    <div>
        <h1>Submission Successful!</h1>
        <p>Your GitHub link has been successfully submitted. Thank you for participating!</p>
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
