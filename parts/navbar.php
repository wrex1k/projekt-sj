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

      .hamburger {
        display: none;
      }

      p,
      a {
        font-family: Glacial;
        font-size: 18px;
        color: black;
        text-decoration: none;
      }

      /*layouts*/
      .container {
        padding: 3% 10% 3% 10%;
      }
    </style>
  </head>

  <body>
    <header class="main-header">
      <nav class="main-nav">
        <ul class="main-menu" id="main-menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="exhibition.php">Exhibition</a></li>
          <li><a href="tickets.php">Tickets</a></li>
        </ul>
        <a class="hamburger" id="hamburger">
          <i class="fa fa-bars"></i>
        </a>
      </nav>
        <img
          src="img/logo.jpg"
          class="Visual Art Gallery logo"
          alt="Visual Art Gallery logo"
        />
      </div>
    </header>
  </body>
</html>
