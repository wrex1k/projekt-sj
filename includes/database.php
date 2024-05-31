<?php
$host = 'localhost';
$db = 'VirtualArtGallery';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $dsn = "mysql:host=$host;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Kontrola, či databáza existuje, ak nie, vytvorí sa
    $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db'");
    if ($stmt->rowCount() == 0) {
        $pdo->query("CREATE DATABASE $db");
    }
    $pdo->query("USE $db");
    
    // Vytvorenie tabuliek projectinmimd, registered a arts
    $pdo->query("CREATE TABLE IF NOT EXISTS projectinmind (
        email VARCHAR(30) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    $pdo->query("CREATE TABLE IF NOT EXISTS registered (
        user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(50) NOT NULL,
        lastname VARCHAR(50) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(50) NOT NULL,
        registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    $pdo->query("CREATE TABLE IF NOT EXISTS arts (
        id INT(5) NOT NULL AUTO_INCREMENT,
        user_id INT(11),
        name VARCHAR(15) NOT NULL,
        price INT(10) NOT NULL,
        image VARCHAR(60) NOT NULL,
        PRIMARY KEY (id)
    )");
    
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
