    <?php
    // informácie pre prihlásenie k databáze
    $db_username = "root";
    $db_password = "";
    $db_name = "website";
    $db_host = "localhost";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // pripojenie k databáze
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            
            // nastavenie režimu pre spracovanie chýb pre objekt PDO, aby bolo možné zachytiť chyby pomocou try catch
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // sql príkaz na doplenie do tabuľky
            $sql = "INSERT INTO project (email) 
            VALUES (:email)";

            // informácie získane z formulára
            $email = $_POST['p_email'];
            
            // príprava a vykonanie príkazu
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // presmerovanie
        header("Location: ../index.php");
        exit();

        } catch (PDOException $e) {
            echo "Chyba: " . $e->getMessage();
        }

        // ukončenie pripojenia k databáze
        $pdo = null;
    }
    ?>