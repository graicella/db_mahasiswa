<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once("db_connect.php");

$query = "SELECT * FROM mahasiswa ORDER BY id DESC";
$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <!-- Link ke Bootstrap untuk styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #d0f0fd; /* Soft Blue background */
            font-family: 'Comic Sans MS', cursive, sans-serif; /* Fun and playful font */
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            color: #6ec5e9; /* Soft Blue for title */
            text-align: center;
            margin-bottom: 30px;
            font-size: 32px;
            font-weight: bold;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #aee4fc; /* Lighter Soft Blue on hover */
        }

        .btn-custom {
            border-radius: 25px; /* Rounded corners for buttons */
            padding: 12px 20px;
        }

        .btn-add {
            background-color: #aee4fc; /* Light Soft Blue for Add button */
            color: #ffffff;
        }

        .btn-logout {
            background-color: #ffb6c1; /* Soft Pink for Logout button */
            color: white;
        }

        .btn-action {
            background-color: #b3e0ff; /* Even softer Baby Blue for action buttons */
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px; /* Rounded corners */
            margin-right: 5px;
        }

        .btn-action:hover {
            background-color: #81d4fa; /* Slightly darker Soft Blue on hover */
        }

        .card {
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff; /* White background for card */
        }

        .thead-dark th {
            background-color: #b3e0ff; /* Soft Blue header for table */
            color: #ffffff;
        }

        /* Rounded table cells */
        .table td, .table th {
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h1>Data Mahasiswa</h1>

        <div class="mb-4">
            <a href="add_mahasiswa.php" class="btn btn-custom btn-add">Tambah Mahasiswa</a>
            <a href="logout.php" class="btn btn-custom btn-logout">Logout</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $counter . "</td>";
                    echo "<td>" . $row['nama_mahasiswa'] . "</td>";
                    echo "<td>" . $row['nim'] . "</td>";
                    echo "<td>" . $row['jurusan'] . "</td>";
                    echo "<td>" . $row['angkatan'] . "</td>";
                    echo "<td>
                            <a href='edit_mahasiswa.php?id=" . $row['id'] . "' class='btn btn-action'>Edit</a> 
                            <a href='delete_mahasiswa.php?id=" . $row['id'] . "' class='btn btn-action'>Delete</a>
                          </td>";
                    echo "</tr>";
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Link ke Bootstrap JS dan jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
