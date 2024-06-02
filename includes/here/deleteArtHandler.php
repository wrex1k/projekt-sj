<?php
require 'database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

function deleteArtHandler($id) {
    global $pdo; // Assumes $pdo is the global variable for database connection

    // Get the image name by ID
    $query = "SELECT image FROM arts WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $imageToDelete = $row['image'];

    // Delete record from database
    $query = "DELETE FROM arts WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Delete image from server
    if (file_exists('../img/arts/' . $imageToDelete)) {
        unlink('../img/arts/' . $imageToDelete);
    }

    header('Location: ../arts.php');
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    deleteArtHandler($id);
} else {
    // Redirect back to profile if ID is not set
    header('Location: ../profile.php');
    exit;
}
?>
