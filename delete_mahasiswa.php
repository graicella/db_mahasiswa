<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once("db_connect.php");

$id = $_GET['id'];
$query = "DELETE FROM mahasiswa WHERE id = '$id'";
mysqli_query($mysqli, $query);

header("Location: index.php");
exit();
?>
