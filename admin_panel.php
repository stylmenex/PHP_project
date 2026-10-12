<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    die("Πρέπει να κάνεις login.");
}

if ($_SESSION['role'] != "admin") {
    die("Δεν έχεις δικαιώματα διαχειριστή.");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h2>Admin Panel</h2>

<p>
Καλώς ήρθες διαχειριστή 
<?php echo $_SESSION['username']; ?>
</p>

<hr>

<h3>Διαχείριση χρηστών</h3>

<a href="admin_create_user.php">
    Δημιουργία χρήστη / διαχειριστή
</a>


<hr>


<h3>Διαχείριση Forum</h3>

<p>
Η διαγραφή posts γίνεται από την αρχική σελίδα.
</p>

<a href="index.php">
    Επιστροφή στο Forum
</a>


</body>

</html>