<?php
session_start();
if (isset($_SESSION['username'])) {
    // Unset the specific session variable
    unset($_SESSION['username']);
}
session_destroy();

// Redirect to the login page or any other desired location
header("Location: index.php");
exit();
?>