<?php
$page_title = 'Edit Media';
include 'partials/header.php';
include '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: manage_media.php");
    exit();
}

$media_id = $_GET['id'];

$sql = "SELECT * FROM media WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$media_id]);
$media = $stmt->fetch();

if (!$media) {
    die("Media not found.");
}
?>

<h1>Edit Media</h1>

<form action="media_handler.php?action=edit" method="POST">
    <input type="hidden" name="media_id" value="<?php echo $media['id']; ?>">

    <label>File Preview</label>
    <div>
        <?php
        if (strpos($media['file_type'], 'image') !== false) {
            echo '<img src="../' . htmlspecialchars($media['file_path']) . '" alt="' . htmlspecialchars($media['alt_text']) . '" style="max-width:400px;">';
        } else {
            echo 'File: <a href="../' . htmlspecialchars($media['file_path']) . '" target="_blank">' . htmlspecialchars($media['file_name']) . '</a>';
        }
        ?>
    </div>

    <label for="alt_text">Alternative Text (for images)</label><br>
    <input type="text" id="alt_text" name="alt_text" value="<?php echo htmlspecialchars($media['alt_text']); ?>">

    <br><br>
    <input type="submit" value="Update Media">
</form>

<?php include 'partials/footer.php'; ?>