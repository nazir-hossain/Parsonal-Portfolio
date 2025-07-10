<?php
session_start();
require_once '../includes/db_connect.php';

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    die("Access denied.");
}

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'upload') {
        if (isset($_FILES['media_file']) && $_FILES['media_file']['error'] === UPLOAD_ERR_OK) {
            $base_dir = '../uploads/';
            $folder = date('Y') . '/' . date('m') . '/';
            $full_path = $base_dir . $folder;

            if (!is_dir($full_path)) {
                mkdir($full_path, 0755, true);
            }

            $info = pathinfo($_FILES['media_file']['name']);
            $ext = strtolower($info['extension']);
            $new_name = uniqid('media_', true) . '.' . $ext;
            $save_path = $full_path . $new_name;

            if (move_uploaded_file($_FILES['media_file']['tmp_name'], $save_path)) {
                $stmt = $pdo->prepare("INSERT INTO media (file_name, file_path, file_type, alt_text) VALUES (?, ?, ?, ?)");
                $stmt->execute([
                    $_FILES['media_file']['name'],
                    'uploads/' . $folder . $new_name,
                    $_FILES['media_file']['type'],
                    $_POST['alt_text'] ?? ''
                ]);
                header("Location: manage_media.php?status=uploaded");
                exit;
            }
        }
    }

    if ($action === 'edit') {
        $id = $_POST['media_id'];
        $alt = $_POST['alt_text'];
        $stmt = $pdo->prepare("UPDATE media SET alt_text = ? WHERE id = ?");
        $stmt->execute([$alt, $id]);
        header("Location: manage_media.php?status=updated");
        exit;
    }
}

exit;