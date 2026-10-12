<?php
$conn = new mysqli("localhost", "root", "", "forum_db");

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}
?>
