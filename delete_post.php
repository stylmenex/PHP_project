<?php

session_start();
include "db.php";
include "menu.php";

// Έλεγχος login
if (!isset($_SESSION['user_id'])) {
    die("Πρέπει να κάνεις login.");
}

// Έλεγχος admin
if ($_SESSION['role'] != "admin") {
    die("Δεν έχεις δικαιώματα.");
}

// Έλεγχος id
if (!isset($_GET['id'])) {
    die("Δεν βρέθηκε post.");
}

$post_id = $_GET['id'];


// 1) Διαγραφή replies πρώτα
$sql = "DELETE FROM replies WHERE post_id = $post_id";
$conn->query($sql);


// 2) Διαγραφή post
$sql = "DELETE FROM posts WHERE id = $post_id";
$conn->query($sql);


// Επιστροφή στο index
header("Location: index.php");
exit();

?>