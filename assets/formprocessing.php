<?php

$host = "localhost";
$dbname = "virtualartgallery";
$port = 3306;
$username = "root";
$password = "";

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);

try {
    $conn = new PDO('mysql:host='.$host.';dbname='.$dbname.';port='.$port, $username, $password, $options);
} catch (PDOException $e) {
    die("Chyba pripojenia:" . $e->getMessage());
}

$meno = $_POST["userName"];
$priezvisko = $_POST["lastName"];
$email = $_POST["email"];
$password = $_POST["password"];

$sql = "INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`) VALUES (NULL, '$meno', '$priezvisko', '$email', '$password')";

$statement = $conn->prepare($sql);

try {
    $instert = $statement->execute();
    header(header: "index.php");
    return $instert;
} catch (PDOException $e) {
    die("Chyba:" . $e->getMessage());
}


?>