<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home</title>
  </head>

  <body>
    <?php
    $file_path = "components/navbar.php";
    if(file_exists($file_path)) {
        include_once($file_path);
    } else {
        echo "Failed to include $file_path. File does not exist.";
    }
    ?>
    <?php
    $file_path = "components/banner.php";
    if(file_exists($file_path)) {
        include_once($file_path);
    } else {
        echo "Failed to include $file_path. File does not exist.";
    }
    ?>
    <?php
    $file_path = "components/footer.php";
    if(file_exists($file_path)) {
        include_once($file_path);
    } else {
        echo "Failed to include $file_path. File does not exist.";
    }
    ?>
  </body>
</html>
