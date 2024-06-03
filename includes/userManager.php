<?php
// vytvorenie session ak session_status je NONE
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'database.php';

// definícia triedy UserManager
class UserManager {
    private $pdo;

    // konštruktor, ktorý prijíma PDO objekt
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // funkcia pre prihlásenie používateľa
    public function login($formData) {
        $email = filter_var($formData['email'], FILTER_SANITIZE_EMAIL); // Sanitizuje email
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($formData['password'], $user['password'])) {
            // nastaví relácie pre prihláseného používateľa
            $_SESSION['loggedin'] = true;
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['registered_at'] = $user['registered_at'];

            // presmeruje používateľa na hlavnú stránku
            header("Location: ../index.php");
            exit();
        } else {
            // v prípade nesprávneho emailu alebo hesla presmeruje späť na prihlasovaciu stránku
            $this->redirectWithMessage('../login.php', 'Invalid email or password.');
        }
    }

    // funkcia pre odhlásenie používateľa
    public function logout() {
        session_unset();
        session_destroy();
        $this->redirectWithMessage('../arts.php', null);
    }

    // funkcia pre registráciu nového používateľa
    public function register($formData) {
        $errorMessage = $this->validate($formData); 
        if ($errorMessage === true) {
            $this->insertUser($formData); 
            $this->redirectWithMessage('../login.php', 'Registration successful. Please log in.');
        } else {
            $this->redirectWithMessage('../register.php', $errorMessage);
        }
    }

    // Funkcia pre aktualizáciu údajov používateľa
    public function updateAccount($formData) {
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $firstname = isset($formData['firstname']) ? $formData['firstname'] : null;
        $lastname = isset($formData['lastname']) ? $formData['lastname'] : null;

        if (!$userId) {
            $this->redirectWithMessage(null, 'User ID is not set in the session.');
        } elseif (!$firstname) {
            $this->redirectWithMessage(null, 'First name is not provided.');
        } elseif (!$lastname) {
            $this->redirectWithMessage(null, 'Last name is not provided.');
        } else {
            try {
                $stmt = $this->pdo->prepare("UPDATE users SET firstname = ?, lastname = ? WHERE user_id = ?");
                $stmt->bindParam(1, $firstname, PDO::PARAM_STR);
                $stmt->bindParam(2, $lastname, PDO::PARAM_STR);
                $stmt->bindParam(3, $userId, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $lastname;
                    $this->redirectWithMessage('../profile.php', '');
                } else {
                    $this->redirectWithMessage(null, 'Error updating profile: ' . $stmt->errorInfo()[2]);
                }

                $stmt->closeCursor();
            } catch (Exception $e) {
                $this->redirectWithMessage(null, 'An error occurred: ' . $e->getMessage());
            }
        }
    }

    // Funkcia pre vymazanie účtu používateľa
    public function deleteAccount($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE user_id = ?");
        if ($stmt->execute([$userId])) {
            session_destroy(); 
            $this->redirectWithMessage('../index.php', 'Account deleted successfully.');
        } else {
            $this->redirectWithMessage(null, 'Error deleting profile: ' . $stmt->errorInfo()[2]);
        }
    }

    // Funkcia na validáciu registračných údajov
    private function validate($formData) {
        if (strlen($formData["firstname"]) < 2 || strlen($formData["firstname"]) > 50 || strlen($formData["lastname"]) < 2 || strlen($formData["lastname"]) > 50) {
            return "First name and last name must be between 2 and 50 characters long.";
        }

        if (!filter_var($formData["email"], FILTER_VALIDATE_EMAIL)) {
            return "Please enter a valid email address.";
        }

        if ($formData["password"] !== $formData["re-password"]) {
            return "Passwords do not match.";
        }

        if (strlen($formData["password"]) < 8 || !preg_match('/[A-Z]/', $formData["password"])) {
            return "Password must contain at least 8 characters including at least one uppercase letter.";
        }

        $stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$formData["email"]]);
        $existingEmail = $stmt->fetchColumn();

        if ($existingEmail) {
            return "This email is already registered.";
        }

        return true;
    }

    // Funkcia na vloženie nového používateľa do databázy
    private function insertUser($formData) {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, 'user')");
        $stmt->execute([
            $formData["firstname"],
            $formData["lastname"],
            $formData["email"],
            password_hash($formData["password"], PASSWORD_DEFAULT)
        ]);
    }

    // Funkcia na presmerovanie s oznamom
    private function redirectWithMessage($location, $message) {
        if ($message) {
            $_SESSION['message'] = $message;
        }
        if ($location) {
            header("Location: $location");
        }
        exit();
    }
}

// Vytvorí inštanciu triedy Database a získa PDO objekt
$database = new Database();
$pdo = $database->getPdo();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userManager = new UserManager($pdo);

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'login':
                $userManager->login($_POST);
                break;
            case 'register':
                $userManager->register($_POST);
                break;
            case 'deleteAccount':
                if (isset($_SESSION['user_id'])) {
                    $userManager->deleteAccount($_SESSION['user_id']);
                } else {
                    $_SESSION['message'] = 'No user is logged in.';
                    header("Location: ../login.php");
                }
                break;
            case 'updateAccount':
                $userManager->updateAccount($_POST);
                break;
            default:
                $_SESSION['message'] = 'Invalid action.';
                header("Location: ../login.php");
        }
    } else {
        $_SESSION['message'] = 'No action specified.';
        header("Location: ../login.php");
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'logout') {
    $userManager = new UserManager($pdo);
    $userManager->logout();
} else {
    $_SESSION['message'] = 'Invalid request method.';
    header("Location: ../login.php");
}
?>
