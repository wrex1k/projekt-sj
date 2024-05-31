<?php
include 'database.php';

// Spracovanie odoslania formulára
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["re-password"];

    // Kontrola dĺžky mena
    if (strlen($firstName) < 2 || strlen($firstName) > 50 || strlen($lastName) < 2 || strlen($lastName) > 50) {
        echo "First name and last name must be between 2 and 50 characters long.";
        exit;
    }

    // Kontrola formátu emailu
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
        exit;
    }

    // Kontrola hesla
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Kontrola sily hesla
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password)) {
        echo "Password must contain at least 8 characters including at least one uppercase letter.";
        exit;
    }

    // Kontrola existujúceho emailu
    $stmt = $pdo->prepare("SELECT email FROM registered WHERE email = ?");
    $stmt->execute([$email]);
    $existingEmail = $stmt->fetchColumn();

    if ($existingEmail) {
        echo "This email is already registered.";
        exit;
    }

    // Vloženie nových udajov do databázy spolu s hashovaním heslom
    $stmt = $pdo->prepare("INSERT INTO registered (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, 'user')");
    $stmt->execute([
        $firstName,
        $lastName,
        $email,
        password_hash($password, PASSWORD_DEFAULT)
    ]);

    // Presmerovanie
    header("Location: ../login.php");
    exit();
} else {
    echo "Invalid request method.";
}
?>
