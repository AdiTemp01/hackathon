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
    <title>Thank You</title>
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
            background: #000;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            position: relative;
        }

        /* Background Animation */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #ff7e5f, #feb47b, #6a11cb, #2575fc);
            background-size: 400% 400%;
            animation: gradientBackground 6s ease infinite;
            z-index: -1;
        }

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        h1 {
            font-size: 4rem;
            text-align: center;
            font-weight: bold;
            color: #fff;
            animation: textEnter 2s ease-out, textBounce 1s ease-in-out;
            margin-bottom: 20px;
        }

        @keyframes textEnter {
            0% { transform: translateY(-100px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes textBounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        p {
            font-size: 1.5rem;
            text-align: center;
            color: #fff;
            margin-bottom: 40px;
            animation: fadeInText 3s ease-out;
        }

        @keyframes fadeInText {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .celebration {
            font-size: 1.5rem;
            color: #ffd700;
            font-weight: bold;
            text-align: center;
            animation: textEnter 3s ease-out;
            margin-top: 20px;
        }

        .btn {
            background-color: #2980b9;
            color: #fff;
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 1.2rem;
            border: none;
            cursor: pointer;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            margin-top: 30px;
            animation: pulse 1s infinite;
        }

        .btn:hover {
            background-color: #3498db;
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
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
                font-size: 2.5rem;
            }

            p {
                font-size: 1.2rem;
            }

            .btn {
                font-size: 1rem;
                padding: 12px 24px;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div> <!-- Dynamic background animation -->
    <div class="content">
        <h1>Congratulations!</h1>
        <p>You've successfully completed the quiz!</p>
        <p class="celebration">Celebrate your achievement! 🎉</p>
        
    </div>

    <div class="confetti" id="confetti"></div> <!-- Confetti -->
    
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
