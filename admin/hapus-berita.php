<?php
session_start();
session_regenerate_id(true);
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$id = (int) $_GET['id'];

mysqli_query($koneksi, "DELETE FROM berita WHERE id='$id'");

header("Location: ../dashboard.php");
