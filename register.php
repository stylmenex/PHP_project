<?php
include "db.php";
include "menu.php";

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password, role) 
            VALUES ('$username', '$password', 'user')";

    if ($conn->query($sql)) {
        echo "Η εγγραφή έγινε επιτυχώς!";
    } else {
        echo "Σφάλμα: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h2>Εγγραφή χρήστη</h2>

<form method="POST">

    Username:
    <input type="text" name="username">

    <br><br>

    Password:
    <input type="password" name="password">

    <br><br>

    <button name="register">
        Εγγραφή
    </button>

</form>

</body>
</html>