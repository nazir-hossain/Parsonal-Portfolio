<?php
$page_title = 'Media Library';
require_once 'partials/header.php';
require_once '../includes/db_connect.php';

$items_per_page = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

$total = $pdo->query("SELECT COUNT(*) FROM media")->fetchColumn();
$total_pages = ceil($total / $items_per_page);

$stmt = $pdo->prepare("SELECT * FROM media ORDER BY uploaded_at DESC LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $items_per_page, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$media = $stmt->fetchAll();
?>

<h1>Media Library</h1>

<div class="content-form" style="margin-bottom: 2rem;">
    <h3>Upload File</h3>
    <form action="media_handler.php?action=upload" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="media_file">Choose File</label>
            <input type="file" id="media_file" name="media_file" required>
        </div>
        <div class="form-group">
            <label for="alt_text">Alt Text</label>
            <input type="text" id="alt_text" name="alt_text">
        </div>
        <button type="submit" class="btn">Upload</button>
    </form>
</div>

<?php if (!empty($_GET['status'])): ?>
    <div class="success-message">
        <?php
        $status = $_GET['status'];
        if ($status === 'uploaded') echo 'File uploaded.';
        elseif ($status === 'deleted') echo 'File deleted.';
        elseif ($status === 'updated') echo 'Media updated.';
        ?>
    </div>
<?php endif; ?>

<div class="media-grid">
    <?php if (empty($media)): ?>
        <p>No media found.</p>
    <?php else: ?>
        <?php foreach ($media as $item): ?>
            <div class="media-item">
                <div class="media-preview">
                    <?php if (strpos($item['file_type'], 'image') !== false): ?>
                        <img src="../<?php echo htmlspecialchars($item['file_path']); ?>" alt="<?php echo htmlspecialchars($item['alt_text']); ?>">
                    <?php else: ?>
                        <div class="file-icon">[PDF]</div>
                    <?php endif; ?>
                </div>
                <div class="media-info">
                    <p class="media-name" title="<?php echo htmlspecialchars($item['file_name']); ?>">
                        <?php echo htmlspecialchars($item['file_name']); ?>
                    </p>
                    <div class="media-actions">
                        <button class="btn-action copy-btn" data-url="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . '/' . htmlspecialchars($item['file_path']); ?>">Copy URL</button>
                        <a href="edit_media.php?id=<?php echo $item['id']; ?>" class="btn-action edit">Edit</a>
                        <a href="delete_media.php?id=<?php echo $item['id']; ?>" class="btn-action delete" onclick="return confirm('Are you sure?');">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.copy-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const url = this.dataset.url;
            navigator.clipboard.writeText(url).then(() => {
                this.textContent = 'Copied!';
                setTimeout(() => { this.textContent = 'Copy URL'; }, 1500);
            }).catch(() => {
                alert('Could not copy.');
            });
        });
    });
});
</script>

<?php require_once 'partials/footer.php'; ?>