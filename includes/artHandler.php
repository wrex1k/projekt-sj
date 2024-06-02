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

    header('Location: ../profile.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'upload') {
        $userId = $_SESSION['user_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $targetDir = "../img/arts/";
        $targetFile = $targetDir . basename($image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the target directory exists, if not, create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['image']['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO arts (user_id, name, price, image) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$userId, $name, $price, $image]);
                    header('Location: ../arts.php');
                    exit();
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'delete') {
        if (isset($_POST['image_id'])) {
            $id = $_POST['image_id'];
            deleteArtHandler($id);
        }
    }
} else {
    // Redirect back to profile if action or ID is not set
    header('Location: ../profile.php');
    exit;
}
?>
