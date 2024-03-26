<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <style>
      @font-face {
        font-family: Glacial;
        src: url(../fonts/GlacialIndifference-Regular.otf);
      }

      body {
        margin: 0;
        padding: 0;
      }

      a, input, h2 {
        font-family: Glacial;
        text-decoration: none;
        color: #fafafa;
      }

      input {
        color: #161616;
      }

      .container {
        display: flex;
        margin: 10vw 25vw;
      }

      .left-half img {
        display: flex;
        min-width: 300px;
        min-height: 450px;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
      }

      .right-half {
        flex: 1;
        background-color: rgba(14, 12, 12, 0.874);
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
      }

      .input-wrapper {
        margin: 50px;
      }

      form {
        display: flex;
        flex-direction: column;
        min-width: 200px;
        max-width: 400px;
      }

      img {
        width: 100%;
        max-width: 300px;
        display: block;
        margin: 0 auto;
      }

      input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
        box-sizing: border-box;
      }

      input[type="submit"] {
        justify-content: center;
        width: 60%;
        padding: 10px;
        background-color: #fafafa;
        color: #191919;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
    </style>
<body>
    <div class="container">
      <div class="left-half">
        <img src="../img/login.jpg" alt="art" />
      </div>
      <div class="right-half">
        <div class="input-wrapper">
        <form method="POST" action="../assets/formlogin.php">
          <h2>Login</h2>
          <input type="text" name="l_nickname" placeholder="Nickname" required />
          <input type="password" name="l_password" placeholder="Password" required />
          <input type="submit" value="Login"  />
        </form>
      </div>
    </div>
  </div>
</body>
</html>
