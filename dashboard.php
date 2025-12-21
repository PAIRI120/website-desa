<?php
session_start();
session_regenerate_id(true);
include "config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Admin Desa</span>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>Dashboard</h3>
    <p>Selamat datang, <b><?= $_SESSION['username'] ?></b></p>

    <a href="admin/tambah-berita.php" class="btn btn-success mb-3">
        + Tambah Berita
    </a>

    <table class="table table-bordered table-striped">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1; while ($data = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['judul'] ?></td>
            <td><?= $data['tanggal'] ?></td>
            <td>
                <a href="admin/edit-berita.php?id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="admin/hapus-berita.php?id=<?= $data['id'] ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Hapus berita?')">
                    Hapus
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>
</div>

</body>
</html>