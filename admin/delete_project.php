<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    die("Access denied.");
}

if (!isset($_GET['id'])) {
    header("Location: manage_projects.php");
    exit();
}

$project_id = $_GET['id'];

$sql = "SELECT main_image FROM projects WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$project_id]);
$project = $stmt->fetch();

if ($project && $project['main_image'] != '') {
    $image_file = '../' . $project['main_image'];
    if (file_exists($image_file)) {
        unlink($image_file);
    }
}

$sql_delete = "DELETE FROM projects WHERE id = ?";
$stmt_delete = $pdo->prepare($sql_delete);
$stmt_delete->execute([$project_id]);

header("Location: manage_projects.php?status=deleted");
exit();