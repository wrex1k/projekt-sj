<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <style>
      @font-face {
        font-family: Glacial;
        src: url(/fonts/GlacialIndifference-Regular.otf);
      }

      body {
        margin: 0;
        padding: 0;
      }

      h1,
      form,
      a,
      button {
        font-family: Glacial;
        color: #fafafa;
        text-decoration: none;
      }

      input{
        color: black;
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

      .button-wrapper {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
      }

      input[type="firstName"],
      input[type="lastName"],
      input[type="email"],
      input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px white;
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
  </head>

  <body>
    <div class="container">
      <div class="left-half">
        <img src="../img/register.jpg " alt="art" />
      </div>
      <div class="right-half">
        <div class="input-wrapper">
        <form id="contact" action="/assets/formprocessing.php">
            <h2>Register</h2>
            <input type="firstName" name="userName" placeholder="First Name" required />
            <input type="lastName" name="lastName" placeholder="Last Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="submit" value="Register" />
          </form>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "virtualartgallery";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

    // Set parameters and execute
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt->execute();

    echo "New records inserted successfully";

    $stmt->close();
    $conn->close();
}
?>