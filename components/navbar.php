<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <style>
    @font-face {
    font-family: 'Glacial';
    src: url('../fonts/GlacialIndifference-Regular.otf');
    }

    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    .navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 60px;
    display: flex;
    justify-content: space-evenly;
    background-color: #ffffff;
    z-index: 1000;
    }


    .main-menu, .logo{
    display: flex;
    flex-direction: row;
    align-items: center;
    list-style: none;
    }

    .main-menu li {
    margin: 0 30px;
    }

    .logo {
    height: 60px;
    }


    .main-menu li a {
    font-family: Glacial;
    color: black;
    font-size: 18px;
    text-decoration: none;
    background-color: #ffffff;
    border: none;
    }

    .main-menu li:hover a, .buttons li:hover a {
    color: #11caae;
    transition: color 0.5s ease;
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar">
        <ul class="main-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="arts.php">Arts</a></li>
            <li><a href="">Empty</a></li>
        </ul>
        <img src="img/logo.jpg" class="logo" alt="Visual Art Gallery logo" />
        <ul class="main-menu">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <li>Welcome, <a href="profile.php"><?php echo $_SESSION['user']; ?></li>
                <li><a href="includes/logoutHandler.php">Logout</a></li>
            <?php else: ?>
              <li><a href="register.php">Register</a></li>  
              <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
  </header>
</body>
</html>

