<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'includes/database.php';

$query = "SELECT 
    arts.name AS art_name, 
    arts.price, 
    arts.image, 
    users.firstname, 
    users.lastname
    FROM 
    arts
    INNER JOIN 
    users ON arts.user_id = users.user_id";

$stmt = $pdo->query($query);
$arts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/gallery.css">
    <title>Gallery</title>
</head>

<body>
    <div class="gallery">
        <?php foreach ($arts as $art): ?>
        <div class="object">
            <img src="img/arts/<?php echo htmlspecialchars($art['image']); ?>"
                alt="<?php echo htmlspecialchars($art['art_name']); ?>">
            <p>Name: &nbsp;
                <?php echo htmlspecialchars($art['art_name']); ?>
            </p>
            <p>Price: &nbsp;
                <?php echo htmlspecialchars($art['price']); ?>€
            </p>
            <p>Added by: &nbsp;
                <?php echo htmlspecialchars($art['firstname']); ?>
                <?php echo htmlspecialchars($art['lastname']); ?>
            </p>
        </div>
        <?php endforeach; ?>
    </div>
</body>

</html>