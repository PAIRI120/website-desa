<?php
include "config/database.php";

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM berita ORDER BY tanggal DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Website Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="#">Desa Kuala Tambangan</a>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">
    <h2 class="mb-4 text-center">Berita Desa</h2>

    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
        <div class="card mb-3 shadow-sm">
            <?php if ($data['gambar']) { ?>
                <img src="assets/img/berita/<?= $data['gambar']; ?>" class="card-img-top">
            <?php } ?>

            <div class="card-body">
                <h5><?= $data['judul']; ?></h5>
                <small class="text-muted"><?= $data['tanggal']; ?></small>
                <p><?= $data['isi']; ?></p>
            </div>
        </div>
    <?php } ?>

    <?php if (mysqli_num_rows($query) == 0) { ?>
        <p class="text-center">Belum ada berita.</p>
    <?php } ?>
</div>

<!-- FOOTER -->
<footer class="bg-light text-center py-3 mt-5">
    <small>© <?= date('Y'); ?> Website Desa</small>
</footer>

</body>
</html>