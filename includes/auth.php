<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function login($pdo, $username, $password) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];

        // Check if the user has already completed the quiz
        // Assuming quiz_complete is stored in the database for each user
        $quizStatusStmt = $pdo->prepare('SELECT quiz_complete FROM users WHERE id = ?');
        $quizStatusStmt->execute([$user['id']]);
        $quizStatus = $quizStatusStmt->fetchColumn();

        if ($quizStatus) {
            // Set session variable if the user has already completed the quiz
            $_SESSION['quiz_complete'] = true;
        } else {
            $_SESSION['quiz_complete'] = false;
        }
        if (isset($_SESSION['quiz_complete']) && $_SESSION['quiz_complete'] === true) {
            echo "<script>alert('You have already attempted the quiz.');</script>";
            header('Location: dashboard.php');  // Redirect to home or dashboard
            exit;
        }
        return true;
    }
    
    return false;
}

?>
