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
    <title>profile</title>
</head>
<body>
<?php
    $file_path = "components/navbar.php";
    if(file_exists($file_path)) {
        include_once($file_path);
    } else {
        echo "Failed to include $file_path. File does not exist.";
    }
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
                    <input class="insert" type="text" name="firstname" value="<?php echo $_SESSION['firstname']; ?>" required>
                    <input class="insert" type="text" name="lastname" value="<?php echo $_SESSION['lastname']; ?>" required>
                    <input class="click" type="submit" value="Update Account">
                </form>
            </div>
            <div class="delete-buttons">
                <form method="POST" action="includes/userManager.php">
                    <input type="hidden" name="action" value="deleteAccount">
                    <button class="click" id="delete" type="submit" value="Delete Account">Delete Account</Button>
                </form>

            </div>
        </div>

        <div class="right-half">
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
                        // Pridanie formulára s tlačidlom na odstránenie
                        echo '<form method="POST" action="includes/artHandler.php">';
                        echo '<input type="hidden" name="image_id" value="' . htmlspecialchars($post['id']) . '">';
                        echo '<button class="delete-button" type="submit">Delete</class=button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "No posts found for the user.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "User is not logged in.";
        }
        ?>
    </div>
</div>

    <script>
        function confirmDeletion(event) {
            if (!confirm("Are you sure you want to delete your profile? This action cannot be undone.")) {
                event.preventDefault();
            }
        }
    </script>
</body>
</html>
