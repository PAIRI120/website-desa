<?php
session_start();
session_regenerate_id(true);
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi   = $_POST['isi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    if ($gambar != "") {
        move_uploaded_file($tmp, "../assets/img/berita/" . $gambar);
    }

    mysqli_query(
        $koneksi,
        "INSERT INTO berita (judul, isi, tanggal, gambar)
         VALUES ('$judul', '$isi', NOW(), '$gambar')"
    );

    header("Location: ../dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">
    <h3>Tambah Berita</h3>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi Berita</label>
            <textarea name="isi" class="form-control" rows="6" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Berita</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button class="btn btn-primary" name="simpan">Simpan</button>
        <a href="../dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
