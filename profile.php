<?php
include 'includes/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/gallery.css">
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
</head>
<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['message'])) {
        echo "<p>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }
    require 'components/navbar.php';
    ?>

    <div class="container">
        <div class="left-half">
            <h1>Profile</h1>
            <div class="profile-info">
                <strong><label for="firstname">Firstname:</label></strong>
                <span><?php echo htmlspecialchars($_SESSION['firstname']); ?></span><br>
                <strong><label for="lastname">Lastname:</label></strong>
                <span><?php echo htmlspecialchars($_SESSION['lastname']); ?></span><br>
                <strong><label for="email">Email:</label></strong>
                <span><?php echo htmlspecialchars($_SESSION['email']); ?></span><br>
                <strong><label for="role">Role:</label></strong>
                <span><?php echo htmlspecialchars($_SESSION['role']); ?></span><br>
                <strong><label for="registered_at">Registered at:</label></strong>
                <span><?php echo htmlspecialchars($_SESSION['registered_at']); ?></span><br>
            </div>

            <div class="profile-form">
                <form method="POST" action="includes/userManager.php">
                    <input type="hidden" name="action" value="updateAccount">
                    <input class="insert" type="text" name="firstname" placeholder="First name" value="<?php echo $_SESSION['firstname']; ?>" required>
                    <input class="insert" type="text" name="lastname" placeholder="Last name" value="<?php echo $_SESSION['lastname']; ?>" required>
                    <input class="click" type="submit" value="Update Account">
                </form> 
            </div>

            <div class="delete-buttons">
                <form method="POST" action="includes/userManager.php" onsubmit="return confirmDelete()">
                    <input type="hidden" name="action" value="deleteAccount">
                    <button class="click" id="delete" type="submit" value="Delete Account">Delete Account</button>
                </form>
            </div>
        </div>

        <div class="right-half">
            <div class="gallery">
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    $user_id = $_SESSION['user_id'];
                    try {
                        $stmt = $pdo->prepare("SELECT * FROM arts WHERE user_id = ?");
                        $stmt->execute([$user_id]);
                        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($posts) > 0) {
                            foreach ($posts as $post) {
                                echo '<div class="object">';
                                echo '<img src="img/arts/' . htmlspecialchars($post['image']) . '" alt="' . htmlspecialchars($post['name']) . '">';
                                echo '<p> name: ' . htmlspecialchars($post['name']) . '</p>';
                                echo '<p> price: ' . htmlspecialchars($post['price']) . '</p>'; 
                                echo '</form>';
                                echo '</div>';
                            }
                        } else {
                            echo "No arts found for the user.";
                        }
                    } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete your account?");
    }
    </script>
</body>
</html>
