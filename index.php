<?php

session_start();

include "db.php";
include "menu.php";

$sql = "SELECT posts.id, posts.content, posts.created_at, users.username
        FROM posts
        JOIN users
        ON posts.user_id = users.id
        ORDER BY posts.created_at DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h2>Forum Posts</h2>

<?php if (isset($_SESSION['username'])): ?>

    <div id="welcome-message">
    Καλώς ήρθες <?php echo $_SESSION['username']; ?>!
    </div>

    <br>

    <a href="create_post.php">Νέο Post</a> |
    
    <?php if ($_SESSION['role']=="admin"): ?>

    <a href="admin_panel.php">
    Admin Panel
    </a> |

    <?php endif; ?>


    <a href="logout.php">Logout</a>

<?php else: ?>

    <a href="login.php">Login</a> |

    <a href="register.php">Register</a>

<?php endif; ?>

<?php

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<h3>" . $row['username'] . "</h3>";

        echo "<p><a href='view_post.php?id=" . $row['id'] . "'>"
                . $row['content'] .
                "</a></p>";

        echo "<small>" . $row['created_at'] . "</small>";

        if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
        echo "<a href='delete_post.php?id=" . $row['id'] . "'>Διαγραφή</a>";
        }

        echo "<hr>";

        
    }

} else {

    echo "Δεν υπάρχουν posts ακόμα.";

}

?>
<script>
setTimeout(function(){

    let message = document.getElementById("welcome-message");

    if(message){
        message.style.display = "none";
    }

}, 3000);
</script>

</body>

</html>