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

      /*overall*/
      html {
        margin-bottom: 15px;
      }

      /*layout*/
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

      .project-wrapper input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #000000;
        box-sizing: border-box;
      }

      .adress-wrapper h3 {
        margin-bottom: 15px;
      }
      .input-wrapper {
        display: flex;
        flex-direction: row;
        width: 300px;
        gap: 10px;
      }

      .send-button {
        padding: 15px 30px;
        border: none;
        background-image: url("img/whale.png");
        background-repeat: no-repeat;
        background-position: 0%;
        background-size: cover;
        cursor: pointer;
        border-radius: 5px;
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

      @media screen and (max-width: 600px) {
      }
    </style>
  </head>
  <body>
    <footer>
      <div class="footer-container">
        <div class="project-wrapper">
          <p>Got a Project in Mind?</p>
          <div class="input-wrapper">
            <input
              type="email"
              id="email"
              name="email"
              placeholder="enter your email"
            />
            <input class="send-button" type="submit" value="" />
          </div>
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
