<?php
session_start();
include 'database.php';

// Spracovanie požiadavky POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validácia a sanatizácia vstupoveho emailu
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Pripravenie a vykonanie SQL príkazu
    $stmt = $pdo->prepare("SELECT * FROM registered WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Overenie zhody hesla a emailu
    if ($user && password_verify($password, $user['password'])) {
        // Nastavenie premenných session
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $user['firstname'];
        $_SESSION['userid'] = $user['user_id'];

        // Presmerovanie
        header("Location: ../index.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>
