<?php

session_start();
include "db.php";
include "menu.php";


if (!isset($_SESSION['user_id'])) {
    die("Πρέπει να κάνεις login.");
}


if ($_SESSION['role'] != "admin") {
    die("Δεν έχεις δικαιώματα διαχειριστή.");
}


if (isset($_POST['create'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    $sql = "INSERT INTO users (username, password, role)
            VALUES ('$username', '$password', '$role')";


    if ($conn->query($sql)) {

        echo "Ο χρήστης δημιουργήθηκε επιτυχώς!";

        echo "<br><br>";

        echo "<a href='index.php'>Επιστροφή στο Forum</a>";

        echo "<br><br>";

        echo "<a href='admin_panel.php'>Επιστροφή στο Admin Panel</a>";

    } else {

        echo "Σφάλμα: " . $conn->error;

    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Admin Create User</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h2>Δημιουργία χρήστη από Admin</h2>


<form method="POST">

Username:

<br>

<input type="text" name="username">

<br><br>


Password:

<br>

<input type="password" name="password">

<br><br>


Ρόλος:

<br>

<select name="role">

    <option value="user">
        User
    </option>

    <option value="admin">
        Admin
    </option>

</select>


<br><br>


<button name="create">
Δημιουργία
</button>



</form>


</body>

</html>