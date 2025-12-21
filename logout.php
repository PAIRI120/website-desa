<?php
session_start();

// Hapus semua data session
$_SESSION = [];

// Hancurkan session
session_destroy();

// Redirect
header("Location: login.php");
exit;

