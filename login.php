<?php
session_start();

include "db.php";
include "menu.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit();
        } else {
            echo "Λάθος password!";
        }

    } else {
        echo "Ο χρήστης δεν βρέθηκε!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Login</h2>

<form method="POST">

    Username:
    <input type="text" name="username">

    <br><br>

    Password:
    <input type="password" name="password">

    <br><br>

    <button type="submit">Login</button>

</form>

</body>
</html>