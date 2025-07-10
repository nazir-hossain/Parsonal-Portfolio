<?php
$page_title = 'Edit Project';
include 'partials/header.php';
include '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: manage_projects.php");
    exit();
}

$project_id = $_GET['id'];

$sql = "SELECT * FROM projects WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$project_id]);
$project = $stmt->fetch();

if (!$project) {
    die("Project not found.");
}
?>

<h1>Edit Project: <?php echo htmlspecialchars($project['title_en']); ?></h1>

<form action="project_handler.php?action=edit" method="POST">
    <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">

    <label for="title_en">Title (English)</label><br>
    <input type="text" id="title_en" name="title_en" value="<?php echo htmlspecialchars($project['title_en']); ?>" required><br><br>

    <label for="title_bn">Title (Bengali)</label><br>
    <input type="text" id="title_bn" name="title_bn" value="<?php echo htmlspecialchars($project['title_bn']); ?>" required><br><br>

    <label for="category">Category</label><br>
    <select id="category" name="category" required>
        <option value="project" <?php if ($project['category'] == 'project') echo 'selected'; ?>>Project</option>
        <option value="research" <?php if ($project['category'] == 'research') echo 'selected'; ?>>Research</option>
        <option value="book" <?php if ($project['category'] == 'book') echo 'selected'; ?>>Book</option>
        <option value="php" <?php if ($project['category'] == 'php') echo 'selected'; ?>>PHP</option>
        <option value="javascript" <?php if ($project['category'] == 'javascript') echo 'selected'; ?>>JavaScript</option>
        <option value="react" <?php if ($project['category'] == 'react') echo 'selected'; ?>>React</option>
    </select><br><br>

    <label for="short_desc_en">Short Description (English)</label><br>
    <textarea id="short_desc_en" name="short_desc_en" rows="3" required><?php echo htmlspecialchars($project['short_desc_en']); ?></textarea><br><br>

    <label for="short_desc_bn">Short Description (Bengali)</label><br>
    <textarea id="short_desc_bn" name="short_desc_bn" rows="3" required><?php echo htmlspecialchars($project['short_desc_bn']); ?></textarea><br><br>

    <label for="long_desc_en">Long Description (English)</label><br>
    <textarea id="long_desc_en" name="long_desc_en" rows="12"><?php echo htmlspecialchars($project['long_desc_en']); ?></textarea><br><br>

    <label for="long_desc_bn">Long Description (Bengali)</label><br>
    <textarea id="long_desc_bn" name="long_desc_bn" rows="12"><?php echo htmlspecialchars($project['long_desc_bn']); ?></textarea><br><br>

    <label for="technologies">Technologies (comma-separated)</label><br>
    <input type="text" id="technologies" name="technologies" value="<?php echo htmlspecialchars($project['technologies']); ?>"><br><br>

    <label for="main_image">Main Image URL</label><br>
    <input type="url" id="main_image" name="main_image" value="<?php echo htmlspecialchars($project['main_image']); ?>" placeholder="https://example.com/image.jpg"><br>
    <?php if ($project['main_image']): ?>
        <img src="<?php echo htmlspecialchars($project['main_image']); ?>" alt="Current Image" width="150" style="border:1px solid #ddd; margin-top:10px;">
    <?php endif; ?>
    <br><br>

    <label for="live_link">Live Link</label><br>
    <input type="url" id="live_link" name="live_link" value="<?php echo htmlspecialchars($project['live_link']); ?>"><br><br>

    <label for="source_code">Source Code Link</label><br>
    <input type="url" id="source_code" name="source_code" value="<?php echo htmlspecialchars($project['source_code']); ?>"><br><br>

    <label for="download_file">Download File Path (optional)</label><br>
    <input type="text" id="download_file" name="download_file" value="<?php echo htmlspecialchars($project['download_file']); ?>"><br><br>

    <input type="submit" value="Update Project">
</form>

<?php include 'partials/footer.php'; ?>