<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>banner</title>
  <style>
    .banner-container {
        position: relative;
        margin-top: 40px;
    }

    .banner-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(0, 0, 0, 0.05);
    }

    .banner {
        width: 100%;
    }
</style>

<main>
  <div class="banner-container">
    <img class="banner" src="img/main8.jpg" alt="gallery">
  </div>
</main>

</body>
</html>