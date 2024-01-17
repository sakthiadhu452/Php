<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["Username"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    echo "Welcome " . $_SESSION["Username"];
    ?>
    <a href="logout.php">Logout</a>
</body>
</html>
