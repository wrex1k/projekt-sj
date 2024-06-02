<?php
include 'database.php';
session_start();
class UserRegistration {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($formData) {
        $errorMessage = $this->validate($formData);
        if ($errorMessage === true) {
            $this->insertUser($formData);
            header("Location: ../login.php");
            exit();
        } else {
            $this->displayError($errorMessage);
        }
    }

    private function validate($formData) {
        // Kontrola dĺžky mena
        if (strlen($formData["firstname"]) < 2 || strlen($formData["firstname"]) > 50 || strlen($formData["lastname"]) < 2 || strlen($formData["lastname"]) > 50) {
            return "First name and last name must be between 2 and 50 characters long.";
        }

        // Kontrola formátu emailu
        if (!filter_var($formData["email"], FILTER_VALIDATE_EMAIL)) {
            return "Please enter a valid email address.";
        }

        // Kontrola hesla
        if ($formData["password"] !== $formData["re-password"]) {
            return "Passwords do not match.";
        }

        // Kontrola sily hesla
        if (strlen($formData["password"]) < 8 || !preg_match('/[A-Z]/', $formData["password"])) {
            return "Password must contain at least 8 characters including at least one uppercase letter.";
        }

        // Kontrola existujúceho emailu
        $stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$formData["email"]]);
        $existingEmail = $stmt->fetchColumn();

        if ($existingEmail) {
            return "This email is already registered.";
        }

        return true;
    }

    private function insertUser($formData) {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, 'user')");
        $stmt->execute([
            $formData["firstname"],
            $formData["lastname"],
            $formData["email"],
            password_hash($formData["password"], PASSWORD_DEFAULT)
        ]);
    }

    private function displayError($errorMessage) {
        echo "<script>alert('$errorMessage'); window.location.href = '../register.php';</script>";
    }
}

// Spracovanie odoslania formulára
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration = new UserRegistration($pdo);
    $registration->register($_POST);
} else {
    echo "Invalid request method.";
}
?>
