<?php 
$page_title = 'Manage Projects';
require_once 'partials/header.php';
require_once '../includes/db_connect.php';

try {
    $stmt = $pdo->query("SELECT id, main_image, title_en, category, view_count, created_at FROM projects ORDER BY created_at DESC");
    $projects = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<h1>Manage Projects</h1>

<a href="add_project.php" class="btn btn-add">Add Project</a>

<?php if (isset($_GET['status'])): ?>
    <div class="success-message">
        <?php 
            $status = $_GET['status'];
            if ($status === 'added') echo 'Project added.';
            elseif ($status === 'updated') echo 'Project updated.';
            elseif ($status === 'deleted') echo 'Project deleted.';
        ?>
    </div>
<?php endif; ?>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Views</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($projects)): ?>
                <tr><td colspan="6">No projects found.</td></tr>
            <?php else: ?>
                <?php foreach ($projects as $p): ?>
                    <tr>
                        <td>
                            <img src="../<?php echo htmlspecialchars($p['main_image'] ?: 'assets/img/placeholder.png'); ?>" alt="Image" class="table-thumb">
                        </td>
                        <td><?php echo htmlspecialchars($p['title_en']); ?></td>
                        <td><span class="category-tag-admin"><?php echo htmlspecialchars($p['category']); ?></span></td>
                        <td><?php echo $p['view_count']; ?></td>
                        <td><?php echo date('M d, Y', strtotime($p['created_at'])); ?></td>
                        <td class="actions">
                            <a href="edit_project.php?id=<?php echo $p['id']; ?>" class="btn-action edit">Edit</a>
                            <a href="delete_project.php?id=<?php echo $p['id']; ?>" class="btn-action delete" onclick="return confirm('Delete this project?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once 'partials/footer.php'; ?>