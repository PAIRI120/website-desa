<?php
session_start();
session_regenerate_id(true);
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM berita WHERE id='$id'")
);

if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $isi   = $_POST['isi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    if ($gambar != "") {
        move_uploaded_file($tmp, "../assets/img/berita/" . $gambar);
        mysqli_query(
            $koneksi,
            "UPDATE berita SET judul='$judul', isi='$isi', gambar='$gambar' WHERE id='$id'"
        );
    } else {
        mysqli_query(
            $koneksi,
            "UPDATE berita SET judul='$judul', isi='$isi' WHERE id='$id'"
        );
    }

    header("Location: ../dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Edit Berita</h3>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text"
                   name="judul"
                   class="form-control"
                   value="<?= $data['judul']; ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi Berita</label>
            <textarea name="isi"
                      class="form-control"
                      rows="6"
                      required><?= $data['isi']; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Ganti Gambar (opsional)</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <?php if ($data['gambar']) { ?>
            <img src="../assets/img/berita/<?= $data['gambar']; ?>" width="150">
        <?php } ?>

        <button class="btn btn-primary" name="update">
            Update Berita
        </button>

        <a href="../dashboard.php" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>

</body>
</html>
