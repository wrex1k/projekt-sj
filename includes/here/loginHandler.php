<?php
session_start();
require 'database.php';

// Spracovanie požiadavky POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validácia a sanatizácia vstupoveho emailu
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Pripravenie a vykonanie SQL príkazu
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Overenie zhody hesla a emailu
    if ($user && password_verify($password, $user['password'])) {
        // Nastavenie premenných session
        $_SESSION['loggedin'] = true;
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['registered_at'] = $user['registered_at'];

        // Presmerovanie
        header('Location: ../index.php');
        exit();
    } else {
        echo "<script>alert('Invalid email or password.'); window.location.href = '../login.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.location.href = '../login.php';</script>";
}
?>
