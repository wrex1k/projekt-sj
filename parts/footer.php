<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>footer</title>
    <style>
      @font-face {
        font-family: Glacial;
        src: url(fonts/GlacialIndifference-Regular.otf);
      }

      * {
        margin: 0px;
        box-sizing: border-box;
      }

      html {
        margin-bottom: 15px;
      }

      .footer-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 2% 15% 2% 10%;
      }

      .project-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        gap: 20px;        
      }

      .input-wrapper {
        display: flex;
        flex-direction: row;
        width: 350px;
        gap: 5px;
      }

      .project-wrapper input[type="email"] {
        width: 65%;
        padding: 10px;
        border: none;
        border: black solid 1px;
        box-sizing: border-box;
        font-family: Glacial;
      }

      .send-button {
        padding: 15px 35px;
        background-image: url("img/whale.png");
        background-repeat: no-repeat;
        background-position: 0%;
        background-size: cover;
        cursor: pointer;
        border: none;
      }

      .adress-wrapper h3 {
        margin-bottom: 15px;
      }

      .copyright {
        display: flex;
        justify-content: center;
      }

      .copyright p {
        font-size: 14px;
      }

      footer p a {
        text-decoration: none;
        color: white;
      }

    </style>
  </head>
  <body>
    <footer>
      <div class="footer-container">
        <div class="project-wrapper">
          <p>Got a Project in Mind?</p>
            <form class="input-wrapper" method="POST" action="assets/project.php" onsubmit="alert('Your email was send on!')">
              <input
                type="email"
                id="email"
                name="p_email"
                placeholder="enter your email"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]"
                required
              />
              <input class="send-button" type="submit" value=""/>
            </form>
        </div>

        <div class="adress-wrapper">
          <h3>New York</h3>
          <p>609 Greenwich Street</p>
          <p>New York, 10014</p>
          <p>(646) - 982 - 1574</p>
          <p>virtualart@gallery.com</p>
        </div>
      </div>
      <div class="copyright">
        <p>&copy; Copyright 2024. All Rights Reserved</p>
      </div>
    </footer>
  </body>
</html>
