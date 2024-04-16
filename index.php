<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
  </head>
  <body>

  <?php
  $file_path = "parts/navbar.php";
  if(file_exists($file_path)) {
      include($file_path);
  } else {
      echo "Failed to include $file_path. File does not exist.";
  }
  ?>

    <?php
  $file_path = "parts/banner.php";
  if(file_exists($file_path)) {
      include($file_path);
  } else {
      echo "Failed to include $file_path. File does not exist.";
  }
  ?>

    <?php
  $file_path = "parts/footer.php";
  if(file_exists($file_path)) {
      include($file_path);
  } else {
      echo "Failed to include $file_path. File does not exist.";
  }
  ?>
  </body>
</html>
