<?php
ob_start();
session_start();

require_once 'db_connect.php';

$available_langs = ['en', 'bn'];
$default_lang = 'en';

if (isset($_GET['lang']) && in_array($_GET['lang'], $available_langs)) {
    $_SESSION['lang'] = $_GET['lang'];
    header("Location: " . basename($_SERVER['PHP_SELF']));
    exit();
}

$lang = isset($_SESSION['lang']) && in_array($_SESSION['lang'], $available_langs) ? $_SESSION['lang'] : $default_lang;
$lang_pack = require_once "languages/{$lang}.php";

try {
    if (strpos($_SERVER['REQUEST_URI'], '/admin/') === false) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $agent = $_SERVER['HTTP_USER_AGENT'];

        $stmt = $pdo->prepare("SELECT id FROM visitors WHERE ip_address = ? AND visit_date > NOW() - INTERVAL 1 DAY");
        $stmt->execute([$ip]);

        if ($stmt->rowCount() === 0) {
            $log = $pdo->prepare("INSERT INTO visitors (ip_address, user_agent) VALUES (?, ?)");
            $log->execute([$ip, $agent]);
        }
    }
} catch (PDOException $e) {
    // Optional: error_log($e->getMessage());
}
?>