<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_mahasiswa'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $angkatan = $_POST['angkatan'];

    $query = "INSERT INTO mahasiswa (nama_mahasiswa, nim, jurusan, angkatan) VALUES ('$nama', '$nim', '$jurusan', '$angkatan')";
    if (mysqli_query($mysqli, $query)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Gagal menambah data!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
</head>
<body>
    <h2>Tambah Mahasiswa</h2>

    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <form method="POST">
        <label for="nama_mahasiswa">Nama Mahasiswa:</label><br>
        <input type="text" name="nama_mahasiswa" required><br><br>

        <label for="nim">NIM:</label><br>
        <input type="text" name="nim" required><br><br>

        <label for="jurusan">Jurusan:</label><br>
        <input type="text" name="jurusan" required><br><br>

        <label for="angkatan">Angkatan:</label><br>
        <input type="number" name="angkatan" required><br><br>

        <button type="submit">Tambah</button>
    </form>
</body>
</html>
