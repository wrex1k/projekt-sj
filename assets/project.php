<?php

    require('../db/database.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO project (email) VALUES (:email)";

            $email = $_POST['p_email'];
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

        header("Location: ../index.php");
        exit();

        } catch (PDOException $e) {
            echo "Chyba: " . $e->getMessage();
        }

        $pdo = null;
    }
    ?>