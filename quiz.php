<?php
session_start();
include 'includes/auth.php';

// Ensure the user is logged in
if (!isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Check if the user has already completed the quiz
if (isset($_SESSION['quiz_complete']) && $_SESSION['quiz_complete'] === true) {
    header('Location: submission.php');  // Redirect to submission page if quiz is already complete
    exit;
}

// Reset quiz status if user is new or hasn't taken the quiz yet
if (!isset($_SESSION['quiz_complete'])) {
    $_SESSION['quiz_complete'] = false;  // Ensure this is false if the quiz hasn't been completed
    $_SESSION['quiz_score'] = 0;  // Reset score
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/quiz.js" defer></script> <!-- External JavaScript file -->
    <title>Quiz</title>
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
            background: linear-gradient(to right,#92a8d1, #fd918f);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            overflow: hidden;
        }

        /* Main Quiz Container */
        #quiz-container {
            background: linear-gradient(to right, #8e44ad, #3498db);;
            padding: 50px 70px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            text-align: center;
            animation: fadeIn 1.5s ease-out;
            width: 90%;
            max-width: 900px;
            transition: all 0.3s ease;
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
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #ecf0f1;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: bold;
        }

        p {
            font-size: 1rem;
            margin-bottom: 30px;
            color: #bdc3c7;
        }

        /* Timer Styling */
        #timer {
            font-size: 1.2rem;
            color: #FFD700;
            margin-bottom: 20px;
        }

        /* Question Container */
        #question-container p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        #question-container ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* Question Options */
        .option {
            background: #34495e;
            color: #fff;
            padding: 15px;
            margin: 10px 0;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }

        .option:hover {
            background: yellowgreen;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.7);
            transform: scale(1.05);
        }

        .option.selected {
            background: pink;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        /* Next Button */
        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .btn {
            background: #2980b9;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #3498db;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.7);
        }

        /* Result Message */
        #result {
            font-size: 1.5rem;
            color: #FFD700;
            font-weight: bold;
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            #quiz-container {
                width: 90%;
                padding: 30px 50px;
            }

            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 1rem;
            }

            #timer {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div id="quiz-container">
        <h1>Question 1</h1>
        <p id="timer">Time Left: 60 seconds</p>
        <div id="question-container"></div>
        <div class="button-container">
            <button id="next-btn" class="btn">Next</button>
        </div>
        <p id="result"></p>
    </div>
</body>
</html>
