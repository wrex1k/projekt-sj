<?php
require 'database.php';

// vytvorenie session ak session_status je NONE
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// spracovanie POST požiadaviek
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'upload') {
        // spracovanie nahrávania obrázku
        $userId = $_SESSION['user_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $targetDir = "../img/arts/";
        $targetFile = $targetDir . basename($image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // vytvorenie cieľového priečinka, ak neexistuje
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // kontrola, či je súbor obrázok
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // kontrola, či súbor už existuje
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // kontrola veľkosti súboru
        if ($_FILES['image']['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // povolené typy súborov
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // ak sú všetky kontroly v poriadku, nahraj súbor
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                try {
                    // uloženie informácií o obrázku do databázy
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
    }
} else {
    // presmerovanie na profilovú stránku
    header('Location: ../profile.php');
    exit;
}
?>
