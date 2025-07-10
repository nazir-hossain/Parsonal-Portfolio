<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    die("Access denied.");
}

if (!isset($_GET['id'])) {
    header("Location: manage_media.php");
    exit();
}

$media_id = $_GET['id'];

$sql = "SELECT file_path FROM media WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$media_id]);
$media = $stmt->fetch();

if ($media) {
    $file = '../' . $media['file_path'];
    if (file_exists($file)) {
        unlink($file);
    }

    $sql_delete = "DELETE FROM media WHERE id = ?";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->execute([$media_id]);
}

header("Location: manage_media.php?status=deleted");
exit();