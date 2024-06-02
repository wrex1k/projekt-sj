<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/footer.css">
    <title>footer</title>
  </head>

  <body>
    <footer>
      <div class="footer-container">
        <div class="project-wrapper">
          <p>Got a Project in Mind?</p>
          <form
            class="input-wrapper"
            method="POST"
            action="includes\projectHandler.php"
            onsubmit="alert('Your email was sent!')"
          >
            <input
              type="email"
              id="project-email"
              name="email"
              placeholder="enter your email"
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]"
              required
            />
            <input class="send-button" type="submit" value="" />
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
