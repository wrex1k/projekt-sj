<?php
// Spustenie session, zrušenie a zničenie session
session_start();
session_unset();
session_destroy();
// Presmerovanie
header("Location: ../arts.php");
exit();
?>
