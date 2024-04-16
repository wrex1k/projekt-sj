<?php

class DatabaseConnection {
    public $host;
    public $username;
    public $password;
    public $dbname;
    public $conn;

    public function __construct($host, $username, $password, $dbname) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password);

        // MySQL pripojenie
        if ($this->conn->connect_error) {
            die("Pripojenie zlyhalo: " . $this->conn->connect_error);
        } else {
            echo "Pripojenie k <strong>MySQL serveru</strong> prebehlo úspešne.<br><br>";
        }

        // vytvorenie databázy, ak neexistuje
        $sql_create_db = "CREATE DATABASE IF NOT EXISTS " . $this->dbname;
        if ($this->conn->query($sql_create_db) === TRUE) {
            echo "<strong>$this->dbname</strong> bola úspešne vytvorená.<br><br>";
        } else {
            echo "Chyba pri vytváraní databázy: " . $this->conn->error . "<br>";
        }

        // pripojenie k databáze
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Pripojenie k databáze zlyhalo: " . $this->conn->connect_error);
        } else {
            echo "<strong>Pripojenie k databáze prebehlo úspešne.</strong><br><br>";
        }

        return $this->conn;
    }

    // vytvorenie project tabuľky, ak neexistuje
    public function create_project() {
        try {
            if (!$this->conn) {
                throw new Exception("Nepripojené k databáze.");
            }

            $sql = "CREATE TABLE IF NOT EXISTS project(
                email VARCHAR(30) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
    

            if ($this->conn->query($sql) === TRUE) {
                echo "Tabuľka <strong>project</strong> bola úspešne vytvorená.<br><br>";
            }
            
        } catch (Exception $e) {
            echo "Chyba: " . $e->getMessage();
        }
    }

    // vytvorenie registered tabuľky, ak neexistuje
    public function create_registered() {
        try {
            if (!$this->conn) {
                throw new Exception("Nepripojené k databáze.");
            }

            $sql = "CREATE TABLE IF NOT EXISTS registered (
                id INT AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(50) NOT NULL,
                lastname VARCHAR(50) NOT NULL,
                nickname VARCHAR(50) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";

            if ($this->conn->query($sql) === TRUE) {
                echo "Tabuľka <strong>registered</strong> bola úspešne vytvorená.<br><br>";
            }
            
        } catch (Exception $e) {
            echo "Chyba: " . $e->getMessage();
        }
    }

    public function create_images() {
        try {
            if (!$this->conn) {
                throw new Exception("Nepripojené k databáze.");
            }

            $sql = "CREATE TABLE IF NOT EXISTS images (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    image_name VARCHAR(255) NOT NULL,
                    image_path VARCHAR(255)
                    )";

            if ($this->conn->query($sql) === TRUE) {
                echo "Tabuľka <strong>images</strong> bola úspešne vytvorená.<br><br>";
            }
            
        } catch (Exception $e) {
            echo "Chyba: " . $e->getMessage();
        }
    }

    public function close() {
        $this->conn->close();
    }
}

// informácie o databáze
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "VirtualArtGallery";

// inštancia triedy connect_create
$databaseManager = new DatabaseConnection($db_host, $db_username, $db_password, $db_name);

$databaseManager->connect();

$databaseManager->create_project();

$databaseManager->create_registered(); 

$databaseManager->create_images();

$databaseManager->close();
?>
