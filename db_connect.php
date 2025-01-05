<?php
$mysqli = new mysqli("localhost", "root", "", "db_mahasiswa");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
