<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

// Get the score from the POST request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['score'])) {
    $_SESSION['quiz_score'] = $data['score'];
    $_SESSION['quiz_complete'] = true;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'No score provided']);
}
?>
