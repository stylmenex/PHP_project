<?php

session_start();
include "db.php";
include "menu.php";

if (!isset($_SESSION['user_id'])) {
    die("Πρέπει να κάνεις login πρώτα.");
}

if (isset($_POST['submit'])) {

    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO posts (user_id, content)
            VALUES ('$user_id', '$content')";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Σφάλμα: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.tiny.cloud/1/1eq1ce8cjshci0lq19490agpssebgjx6fu6ev5b21fvcv4rw/tinymce/6/tinymce.min.js"></script>

<script>
tinymce.init({
    selector: 'textarea'
});
</script>

</head>

<body>

<h2>Νέο Post</h2>

<form method="POST">

    <textarea name="content" rows="5" cols="40"></textarea>

    <br><br>

    <button name="submit">
        Δημοσίευση
    </button>

</form>

</body>
</html>