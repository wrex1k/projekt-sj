<!DOCTYPE html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <title>navbar</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <ul class="main-menu">
                <li class="item"><a href="index.php">Home</a></li>
                <li class="item"><a href="arts.php">Arts</a></li>
                <li class="item"><a href="qna.php">QnA</a></li>
            </ul>
            <img src="img/logo.jpg" class="logo" alt="Visual Art Gallery logo" />
            <ul class="main-menu">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <p>Welcome, &nbsp;</p>
                <li class="name"><a href="profile.php">
                        <?php echo $_SESSION['firstname']; ?>
                    </a></li>
                <li class="item"><a href="includes/userManager.php?action=logout">Logout</a></li>

                <?php else: ?>
                <li class="item"><a href="register.php">Register</a></li>
                <li class="item"><a href="login.php">Login</a></li>
            </ul>
            <?php endif; ?>
        </nav>
    </header>
</body>

</html>