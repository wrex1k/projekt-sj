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
            $sql = "INSERT INTO users (firstName, lastName, nickName, email, password) 
            VALUES (:firstName, :lastName, :nickName, :email, :password)";

            // informácie získane z formulára
            $firstName = $_POST['r_firstname'];
            $lastName = $_POST['r_lastname'];
            $nickName = $_POST['r_nickname'];
            $email = $_POST['r_email'];
            $password = $_POST['r_password'];
            
            // príprava a vykonanie príkazu
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':nickName', $nickName, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            
            // presmerovanie na inú stránku po úspešnej registrácii
        header("Location: ../includes/registrationsuccess.php");
        exit();

        } catch (PDOException $e) {
            echo "Chyba: " . $e->getMessage();
        }

        // ukončenie pripojenia k databáze
        $pdo = null;
    }
    ?>