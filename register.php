<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/forms.css">
  <title>Register</title>
</head>
<body>
  <div class="container">
    <div class="left-half">
      <img src="img/register.jpg" alt="art" />
    </div>
    <div class="right-half">
      <div>
          <form class="reglog-wrapper" id="registrationForm" method="POST" action="includes/userManager.php" onsubmit="return validateForm()">
            <h2 class="white">Register</h2>
            <input class="insert" id="firstname" type="text" name="firstname" placeholder="First Name" required />
            <input class="insert" id="lastname" type="text" name="lastname" placeholder="Last Name" required />
            <input class="insert" id="email" type="email" name="email" placeholder="E-mail" required />
            <div class="line">
              <input class="insert" id="password" type="password" name="password" placeholder="Password" required />
              <input class="checkbox" type="checkbox" id="showpassword" onchange="togglePasswordVisibility()" />
            </div>
            <input class="insert" id="re-password" type="password" name="re-password" placeholder="Confirm Password" required />
            <div class="terms">
              <input class="" type="checkbox" name="agree-terms" id="agree-terms" class="terms" required />
              <a href="terms.php" class="white"><p>I agree to the terms and conditions</p></a>
            </div>
            <input type="hidden" name="action" value="register">
            <input class="click" type="submit" value="Register" />
          </form>
      </div>
    </div>
  </div>
  <script src="js/passwordVisibility.js"></script>
</body>
</html>
