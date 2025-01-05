<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once("db_connect.php");

$id = $_GET['id'];
$query = "SELECT * FROM mahasiswa WHERE id = $id";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_mahasiswa'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $angkatan = $_POST['angkatan'];

    $query = "UPDATE mahasiswa SET nama_mahasiswa = '$nama', nim = '$nim', jurusan = '$jurusan', angkatan = '$angkatan' WHERE id = $id";
    if (mysqli_query($mysqli, $query)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Gagal mengedit data!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
</head>
<body>
    <h2>Edit Mahasiswa</h2>

    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="nama_mahasiswa">Nama Mahasiswa:</label><br>
        <input type="text" name="nama_mahasiswa" value="<?php echo $row['nama_mahasiswa']; ?>" required><br><br>

        <label for="nim">NIM:</label><br>
        <input type="text" name="nim" value="<?php echo $row['nim']; ?>" required><br><br>

        <label for="jurusan">Jurusan:</label><br>
        <input type="text" name="jurusan" value="<?php echo $row['jurusan']; ?>" required><br><br>

        <label for="angkatan">Angkatan:</label><br>
        <input type="number" name="angkatan" value="<?php echo $row['angkatan']; ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
