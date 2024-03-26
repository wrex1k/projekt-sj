<?php
// Prihlasovacie údaje k databáze
$db_username = "root";
$db_password = "";
$db_name = "website";
$db_host = "localhost";

try {
    // Pripojenie k databáze pomocou PDO
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    
    // Nastavenie režimu chybových výpisov pre PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Príprava SQL dotazu pre overenie údajov
        $sql = "SELECT * FROM users WHERE nickName = :nickName AND password = :password";
        
        // Hodnoty získané z prihlasovacieho formulára
        $nickName = $_POST['l_nickname'];
        $password = $_POST['l_password'];
        
        // Príprava a vykonanie príkazu pomocou PDO prepared statement
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nickName', $nickName, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        
        // Overenie, či sa našiel záznam s danými prihlasovacími údajmi
        if ($stmt->rowCount() == 1) {
            // Prihlasovacie údaje sú správne, presmerujeme na úspešnú stránku
            header("Location: ../success.php");
            exit;
        } else {
            echo "Nesprávne prihlasovacie údaje.";
        }
    }

} catch (PDOException $e) {
    echo "Chyba: " . $e->getMessage();
} finally {
    // Uzavretie spojenia s databázou
    $pdo = null;
}
?>