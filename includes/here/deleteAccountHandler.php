<?php
session_start();
include 'database.php'; // Ensure this includes the correct database connection setup

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];

    if ($userId) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
        if ($stmt->execute([$userId])) {
            session_destroy(); // Destroy session after account deletion
            header("Location: ../index.php"); // Redirect to a goodbye or home page
            exit();
        } else {
            echo "<script>alert('Error deleting profile: " . $stmt->errorInfo()[2] . "');</script>";
        }
    } else {
        echo "<script>alert('User ID is required!');</script>";
    }
}
?>