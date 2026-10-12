<?php
session_start();
include "db.php";
include "menu.php";

if (!isset($_GET['id'])) {
    die("Δεν βρέθηκε post.");
}

$post_id = $_GET['id'];

if (isset($_POST['reply']) && isset($_SESSION['user_id'])){
    $content = $_POST['reply_content'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO replies (post_id, user_id, content)
            VALUES ('$post_id', '$user_id', '$content')";

    $conn->query($sql);
}

$sql = "SELECT posts.content, posts.created_at, users.username
        FROM posts
        JOIN users
        ON posts.user_id = users.id
        WHERE posts.id = $post_id";

$result = $conn->query($sql);
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post</title>
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.tiny.cloud/1/1eq1ce8cjshci0lq19490agpssebgjx6fu6ev5b21fvcv4rw/tinymce/6/tinymce.min.js"></script>

    <script>
    tinymce.init({
        selector: 'textarea'
    });
    </script>

</head>
<body>
    <h2>Post</h2>

    <h3><?php echo $post['username']; ?></h3>

    <p><?php echo $post['content']; ?></p>

    <small><?php echo $post['created_at']; ?></small>

    <hr>

    <h2>Απαντήσεις</h2>

    <?php
    $sql = "SELECT replies.content, replies.created_at, users.username
            FROM replies
            JOIN users
            ON replies.user_id = users.id
            WHERE replies.post_id = $post_id
            ORDER BY replies.created_at ASC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<b>" . $row['username'] . "</b><br>";
            echo $row['content'];
            echo "<br>";
            echo "<small>" . $row['created_at'] . "</small>";
            echo "<hr>";
        }
    } else {
        echo "Δεν υπάρχουν απαντήσεις ακόμα.";
    }
    ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <hr>
        <h2>Γράψε απάντηση</h2>

        <form method="POST">
            <textarea name="reply_content" rows="5" cols="40"></textarea>
            <br><br>
            <button name="reply">Απάντηση</button>
        </form>
    <?php else: ?>
        <p>Πρέπει να κάνεις login για να απαντήσεις.</p>
    <?php endif; ?>
</body>
</html>