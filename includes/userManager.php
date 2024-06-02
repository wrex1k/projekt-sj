<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'database.php';

class UserManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($formData) {
        $email = filter_var($formData['email'], FILTER_SANITIZE_EMAIL);
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($formData['password'], $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['registered_at'] = $user['registered_at'];

            header('Location: ../index.php');
            exit();
        } else {
            echo "<script>alert('Invalid email or password.'); window.location.href = '../login.php';</script>";
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../arts.php");
        exit();
    }

    public function register($formData) {
        $errorMessage = $this->validate($formData);
        if ($errorMessage === true) {
            $this->insertUser($formData);
            header("Location: ../login.php");
            exit();
        } else {
            $this->displayError($errorMessage);
        }
    }

    public function updateAccount($formData) {
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $firstname = isset($formData['firstname']) ? $formData['firstname'] : null;
        $lastname = isset($formData['lastname']) ? $formData['lastname'] : null;

        if (!$userId) {
            echo "User ID is not set in the session.";
        } elseif (!$firstname) {
            echo "First name is not provided.";
        } elseif (!$lastname) {
            echo "Last name is not provided.";
        } else {
            try {
                $stmt = $this->pdo->prepare("UPDATE users SET firstname = ?, lastname = ? WHERE user_id = ?");
                $stmt->bindParam(1, $firstname, PDO::PARAM_STR);
                $stmt->bindParam(2, $lastname, PDO::PARAM_STR);
                $stmt->bindParam(3, $userId, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $lastname;
                    header('Location: ../profile.php');
                } else {
                    echo "Error updating profile: " . $stmt->errorInfo()[2];
                }

                $stmt->closeCursor();
            } catch (Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }
        }
    }

    public function deleteAccount($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE user_id = ?");
        if ($stmt->execute([$userId])) {
            session_destroy(); // Destroy session after account deletion
            header("Location: ../index.php"); // Redirect to a goodbye or home page
            exit();
        } else {
            echo "<script>alert('Error deleting profile: " . $stmt->errorInfo()[2] . "');</script>";
        }
    }

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

    private function insertUser($formData) {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, 'user')");
        $stmt->execute([
            $formData["firstname"],
            $formData["lastname"],
            $formData["email"],
            password_hash($formData["password"], PASSWORD_DEFAULT)
        ]);
    }

    private function displayError($errorMessage) {
        echo "<script>alert('$errorMessage'); window.location.href = '../register.php';</script>";
    }
}

$database = new Database();
$pdo = $database->getPdo(); // Updated to use getPdo method

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
                    echo "<script>alert('No user is logged in.'); window.location.href = '../login.php';</script>";
                }
                break;
            case 'updateAccount':
                $userManager->updateAccount($_POST);
                break;
            default:
                echo "<script>alert('Invalid action.'); window.location.href = '../login.php';</script>";
        }
    } else {
        echo "<script>alert('No action specified.'); window.location.href = '../login.php';</script>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'logout') {
    $userManager = new UserManager($pdo);
    $userManager->logout();
} else {
    echo "<script>alert('Invalid request method.'); window.location.href = '../login.php';</script>";
}
?>
