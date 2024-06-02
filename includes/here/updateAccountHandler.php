<?php
require 'database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;

    if (!$userId) {
        echo "User ID is not set in the session.";
    } elseif (!$firstname) {
        echo "First name is not provided.";
    } elseif (!$lastname) {
        echo "Last name is not provided.";
    } else {
        try {
            // Use the $pdo object from the Database class
            global $pdo; // Ensure $pdo is available in this scope
            $stmt = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ? WHERE user_id = ?");
            $stmt->bindParam(1, $firstname, PDO::PARAM_STR);
            $stmt->bindParam(2, $lastname, PDO::PARAM_STR);
            $stmt->bindParam(3, $userId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Update session variables
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                
                header('Location: ../profile.php');
            } else {
                echo "Error updating profile: " . $stmt->errorInfo()[2];
            }

            $stmt->closeCursor();
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid request method.";
}
?>
