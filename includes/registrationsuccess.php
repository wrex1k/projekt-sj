<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <style>
    @font-face {
      font-family: Glacial;
      src: url(../fonts/GlacialIndifference-Regular.otf);
    }

    body {
      margin: 0;
      padding: 0;
    }

    h1,
    form,
    a {
      font-family: Glacial;
      color: #fafafa;
      text-decoration: none;
    }

    a, input {
      color: #161616;
    }

    .container {
      display: flex;
      margin: 10vw 25vw;
      border: #44482443 1px solid;
      border-radius: 10px;
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

    button {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px white;
      border-radius: 5px;
      box-sizing: border-box;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="left-half">
      <img src="../img/registersuccess.jpg" alt="art" />
    </div>
    <div class="right-half">
      <div class="input-wrapper">
        <form method="POST" action="../assets/formregister.php">
          <h2>Registration succesfull!</h2>
          <button><a href="login.php">Login</a></button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>