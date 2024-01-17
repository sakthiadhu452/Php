<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["Username"])) {
    header("Location: home_page.php");
    exit();
}

if (isset($_POST["register"])) {
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $Mobile = $_POST["Mobile"];
    $Password = $_POST["Password"];
    $errors = array();

    if (empty($Name) || empty($Email) || empty($Mobile) || empty($Password)) {
        array_push($errors, "ALL FIELDS ARE REQUIRED");
    }
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Enter valid email");
    }
    if (strlen($Password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<script>alert('$error')</script>";
        }
    } else {
        require_once "mysql.php";
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO login_cred (Name, Email, Password, Mobile) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $Name, $Email, $hashedPassword, $Mobile);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "<script>alert('registered successfully')</script>";
            } else {
                echo "Error: No rows were affected. " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if (isset($_POST["login"])) {
    $Email = $_POST["Email"];
    $Password = $_POST["Password"];
    require_once "mysql.php";

    $sql = "SELECT * FROM login_cred WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($result->num_rows > 0 && password_verify($Password, $row['Password'])) {
        $_SESSION["Username"] = $row["Name"];
        $_SESSION["Pass"] = $row["Pass"];
        echo "<script>window.location.href='home_page.php';</script>";
        exit();
    } else {
        echo "<script>alert('Invalid credentials')</script>";
    }
}
?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="container">
    <div class="registering_form">

<form action="index.php" id="register_form" method="post">
    <div class="form-group">
        <input type="text" name="Name" placeholder="full name">
    </div>
    <div class="form-group">
        <input type="email" name="Email" placeholder="email">
    </div>
    <div class="form-group">
        <input type="mobile" name="Mobile" placeholder="mobile">
    </div>
    <div class="form-group">
        <input type="password" name="Password" placeholder="password">
    </div>
    <div class="form-group" style="margin:auto ;color:white">
        <input type="submit" name="register" value="Register" class="register_button">
    </div>
</form>
<div class="direct2login">Already user <button id="loginhere"  onclick="toggleForms()">login here</button></div>

</div>
<div class="logining_form">
<form action="index.php" id="login_form" method="post">
    
    <div class="form-group">
        <input type="email" name="Email" placeholder="email">
    </div>
    
    <div class="form-group">
        <input type="password" name="Password" placeholder="password">
    </div>
    <div class="form-group" style="margin:auto ;color:white">
        <input type="submit" name="login" value="Login" class="register_button">
    </div>
</form>
<div class="direct2login">New user <button id="loginhere"  onclick="toggleForms()">Register here</button></div>

</div>
    </div>
  
</body>
<Script>
function toggleForms() {
            var loginForm = document.querySelector('.logining_form');
            var registrationForm = document.querySelector('.registering_form');

            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                registrationForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                registrationForm.style.display = 'block';
            }
        }
</Script>

</html>