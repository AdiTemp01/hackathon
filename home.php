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
    <title>Hackathon - Quiz Rules</title>
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
            background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            overflow: hidden;
            animation: backgroundAnimation 10s infinite alternate;
            animation-duration: 6s;
        }

        @keyframes backgroundAnimation {
            0% { background: linear-gradient(45deg, #ff6a00 0%, #ee0979 100%); }
            50% { background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%); }
            100% { background: linear-gradient(45deg, #ff6a00 0%, #ee0979 100%); }
        }

        /* Main Container */
        .container {
            background: rgba(0, 0, 0, 0.6);
            padding: 40px 60px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            text-align: center;
            width: 80%;
            max-width: 600px;
            animation: fadeIn 2s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: bold;
        }

        p {
            font-size: 1.25rem;
            margin: 20px 0;
            color: #d4d4d4;
        }

        .instructions {
            font-size: 1rem;
            color: #ffd700;
            text-align: left;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            padding: 15px 25px;
            margin-top: 20px;
            background: #2575fc;
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }

        a:hover {
            background: #6a11cb;
            transform: scale(1.1);
        }

        a:active {
            background: #ff6a00;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                width: 90%;
                padding: 25px;
            }

            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 1rem;
            }

            .instructions {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Hackathon Quiz Rules</h1>

        <p>Welcome to the Hackathon Quiz Challenge! To move on to the submission phase, you need to answer at least <strong>7 out of 10 questions correctly</strong>.</p>

        <div class="instructions">
            <h2>Instructions:</h2>
            <ul>
                <li>Each question will have multiple options, but only one correct answer.</li>
                <li>You have <strong>60 seconds</strong> for each question.</li>
                <li>Once you complete the quiz, you'll be able to move to the submission page.</li>
                <li>Good luck! Make sure to read the questions carefully before answering.</li>
            </ul>
        </div>

        <a href="quiz.php">Attempt Quiz</a>
    </div>

</body>
</html>
