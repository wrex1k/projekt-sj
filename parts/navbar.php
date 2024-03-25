<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>navbar</title>
    <style>
      @font-face {
        font-family: Glacial;
        src: url(fonts/GlacialIndifference-Regular.otf);
      }

      * {
        margin: 0px;
        box-sizing: border-box;
      }

      /*overall*/
      html {
        margin-top: 40px;
      }

      /*navbar*/
      header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: space-around;
        background-color: #ffffff;
        z-index: 1;
        max-width: 100%;
      }
      .logo {
        height: 55px;
      }

      .main-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
      }
      .main-menu li {
        display: inline;
      }

      .main-menu li a {
        text-decoration: none;
        margin: 0 20px 0 20px;
      }
      .main-menu li:hover a,
      .login-button:hover,
      .register-button:hover {
        color: #11caae;
        transition: color 0.9s ease;
      }

      .navbar-buttons {
        display: flex;
        flex-direction: row;
      }

      .login-button,
      .register-button {
        margin: 0 15px 0 15px;
        text-transform: lowercase;
        background-color: #ffffffb2;
        color: rgb(0, 0, 0);
        cursor: pointer;
        border: none;
      }

      .hamburger {
        display: none;
      }

      p,
      a,
      button {
        font-family: Glacial;
        font-size: 18px;
        color: black;
        text-decoration: none;
      }

      /*layouts*/
      .container {
        padding: 3% 10% 3% 10%;
      }

      @media screen and (max-width: 600px) {
        main {
          margin-top: 0px;
        }
        .row {
          flex-direction: column;
        }
        .main-menu {
          display: none;
        }
        .hamburger {
          display: inline;
        }
        .main-header {
          position: relative;
          top: 0px;
        }

        /*layouts*/
        .main-menu {
          display: none;
        }
        .hamburger {
          display: inline;
        }
        .main-header {
          position: relative;
          top: 0px;
        }
        .main-menu.responsive {
          display: block;
          position: absolute;
          background-color: #f7f7f7;
          width: 100%;
          top: 60px;
          left: 0px;
          padding-top: 20px;
          padding-bottom: 20px;
        }
        .main-menu.responsive li {
          display: block;
          margin-left: 0px;
        }
      }
    </style>
  </head>

  <body>
    <header class="main-header">
      <nav class="main-nav">
        <ul class="main-menu" id="main-menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="">Gallery</a></li>
          <li><a href="">Tickets</a></li>
          <li><a href="">Events</a></li>
        </ul>
        <a class="hamburger" id="hamburger">
          <i class="fa fa-bars"></i>
        </a>
      </nav>
      <div>
        <img
          src="img/logo.jpg"
          class="Visual Art Gallery logo"
          alt="Visual Art Gallery logo"
        />
      </div>
      <div class="navbar-buttons">
        <div>
          <a href="includes/login.php" class="login-button">login</a>
        </div>
        <div>
          <a href="includes/registration.php" class="register-button"
            >register</a
          >
        </div>
      </div>
    </header>
  </body>
</html>
