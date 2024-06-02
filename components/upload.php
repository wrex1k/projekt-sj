<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/forms.css">
    <title>Upload</title>
</head>

<body>
<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): 
    ?>
    <form class="upload-form" action="includes/artHandler.php" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="line">
            <div class="column">
                <label for="name">Art Name</label>
                <input class="insert" type="text" name="name" id="name" required> <br>
                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required>
                <label class="click" for="image" id="upload-label">Select Image</label>
            </div>
            <div class="column">
                <label for="price">Art Price</label>
                <input class="insert" type="text" name="price" id="price" required> <br>
                <input type="hidden" name="action" value="upload">
                <input class="click" type="submit" name="submit" id="submit" value="Submit">
            </div>
        </div>
    </form>
    <?php endif; ?>
</body>

</html>
