<?php
include_once 'includes/init.php';

// Validate project ID from query string
$project_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($project_id <= 0) {
    header("Location: projects.php");
    exit;
}

// Update view count (non-blocking)
try {
    $updateView = $pdo->prepare("UPDATE projects SET view_count = view_count + 1 WHERE id = ?");
    $updateView->execute([$project_id]);
} catch (PDOException $err) {
    // Ignore failure, no need to break user flow
}

// Get project data
try {
    $getProject = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $getProject->execute([$project_id]);
    $project = $getProject->fetch();
} catch (PDOException $err) {
    die("Something went wrong while fetching the project details.");
}

if (!$project) {
    $pageTitle = 'Project Not Found';
    include_once 'includes/header.php';
    echo '<section class="content-section" style="text-align: center;">';
    echo '<h1>Project Not Found</h1>';
    echo '<p>We couldn’t find the project you’re looking for.</p>';
    echo '<br><a href="projects.php" class="cta-button">Go Back</a>';
    echo '</section>';
    include_once 'includes/footer.php';
    exit;
}

$pageTitle = $project['title_' . $lang];
include_once 'includes/header.php';

// Convert tech list to array
$techList = [];
if (!empty($project['technologies'])) {
    $techList = array_map('trim', explode(',', $project['technologies']));
}
?>

<div class="project-detail-container">
    <article class="project-detail-content reveal-on-scroll">
        <h1><?= htmlspecialchars($project['title_' . $lang]); ?></h1>

        <div class="project-meta">
            <span class="category-tag"><?= htmlspecialchars($project['category']); ?></span>
            <span class="meta-item">Published: <?= date('F j, Y', strtotime($project['created_at'])); ?></span>
        </div>

        <img src="<?= htmlspecialchars($project['main_image'] ?? 'assets/img/placeholder.png'); ?>"
             alt="<?= htmlspecialchars($project['title_en']); ?>"
             class="project-detail-image" />

        <div class="project-body">
            <?= $project['long_desc_' . $lang]; ?>
        </div>

        <?php if (!empty($techList)): ?>
        <div class="project-tech">
            <h3>Tools & Technologies</h3>
            <div class="tech-tags">
                <?php foreach ($techList as $tool): ?>
                    <span class="tech-tag"><?= htmlspecialchars($tool); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="project-actions">
            <?php if (!empty($project['live_link'])): ?>
                <a href="<?= htmlspecialchars($project['live_link']); ?>" class="cta-button" target="_blank">
                    <?= $lang_pack['live_demo']; ?>
                </a>
            <?php endif; ?>

            <?php if (!empty($project['source_code'])): ?>
                <a href="<?= htmlspecialchars($project['source_code']); ?>" class="cta-button secondary" target="_blank">
                    <?= $lang_pack['source_code']; ?>
                </a>
            <?php endif; ?>

            <?php if (!empty($project['download_file'])): ?>
                <a href="<?= htmlspecialchars($project['download_file']); ?>" class="cta-button" download>
                    Download PDF
                </a>
            <?php endif; ?>
        </div>
    </article>
</div>

<?php include_once 'includes/footer.php'; ?>