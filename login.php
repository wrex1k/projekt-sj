<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/forms.css">
    <title>Login</title>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo "<p>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }
    ?>
    <div class="container">
        <div class="left-half">
            <img src="img/login.jpg" alt="art" />
        </div>
        <div class="right-half">
            <div>
                <form class="reglog-wrapper" method="POST" action="includes/userManager.php">
                    <h2 class="white">Login</h2>
                    <input class="insert" id="email" type="email" name="email" placeholder="Email" required />
                    <div class="line">
                        <input class="insert" id="password" type="password" name="password" placeholder="Password" required />
                        <input class="checkbox" type="checkbox" id="showpassword" onchange="togglePasswordVisibility()" />
                    </div>
                    <input class="insert" type="hidden" name="action" value="login">
                    <input class="click" type="submit" value="Login" />
                </form>
            </div>
        </div>
    </div>
    <script src="js/passwordVisibility.js"></script>
</body>
</html>
