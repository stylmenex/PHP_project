<?php

session_start();

if (isset($_SESSION['username'])) {

    echo "Καλώς ήρθες " . $_SESSION['username'];

} else {

    echo "Δεν είσαι συνδεδεμένος";

}

?>