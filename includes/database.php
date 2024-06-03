<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Database {
    private $host = 'localhost';
    private $db = 'VirtualArtGallery';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    private $pdo;

    public function __construct() {
        $this->connect(); 
        $this->checkDatabase(); 
        $this->createTables();
    }

    private function connect() {
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $dsn = "mysql:host={$this->host};charset={$this->charset}";
        $this->pdo = new PDO($dsn, $this->user, $this->pass, $options); 
    }

    private function checkDatabase() {
        $stmt = $this->pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$this->db}'");
        if ($stmt->rowCount() == 0) {
            $this->pdo->query("CREATE DATABASE {$this->db}");
        }
        $this->pdo->query("USE {$this->db}");
    }

    private function createTables() {
        $tables = [
            "CREATE TABLE IF NOT EXISTS users (
                user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(50) NOT NULL,
                lastname VARCHAR(50) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                role VARCHAR(50) NOT NULL,
                registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            "CREATE TABLE IF NOT EXISTS arts (
                id INT(5) NOT NULL AUTO_INCREMENT,
                user_id INT(11),
                name VARCHAR(15) NOT NULL,
                price INT(10) NOT NULL,
                image VARCHAR(60) NOT NULL,
                PRIMARY KEY (id)
            )"
        ];

        foreach ($tables as $query) {
            $this->pdo->query($query);
        }
    }

    public function addAdmin() {
        $hashedPassword = password_hash('admin', PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email, password, role) SELECT ?, ?, ?, ?, ? FROM DUAL WHERE NOT EXISTS (SELECT * FROM users WHERE role = 'admin')");
        $stmt->execute(['admin', '', 'admin@virtualartgallery.com', $hashedPassword, 'admin']);

        echo $stmt->rowCount() ? "Administrator added" : "";
    }

    public function getPdo() {
        return $this->pdo;
    }
}

$database = new Database();
$database->addAdmin();
$pdo = $database->getPdo();

?>
