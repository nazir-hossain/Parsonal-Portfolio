<?php
include_once 'includes/init.php';

$pageTitle = $lang_pack['page_title_projects'];
include_once 'includes/header.php';

$projects = [];
$error = null;

// Try fetching all projects
try {
    $query = $pdo->query("SELECT id, category, title_en, title_bn, short_desc_en, short_desc_bn, main_image FROM projects ORDER BY created_at DESC");
    $projects = $query->fetchAll();
} catch (PDOException $ex) {
    // Set a visible fallback message (no hard crash)
    $error = 'Could not load project list at the moment.';
    // For production: error_log($ex->getMessage());
}
?>

<section class="content-section">
    <div class="fade-in">
        <h1><?= $lang_pack['projects_title']; ?></h1>
        <p><?= $lang_pack['projects_description']; ?></p>
    </div>

    <div id="project-filters" class="fade-in">
        <button class="filter-btn active" data-filter="all"><?= $lang_pack['filter_all']; ?></button>
        <button class="filter-btn" data-filter="php">PHP</button>
        <button class="filter-btn" data-filter="javascript">JavaScript</button>
        <button class="filter-btn" data-filter="research">Research</button>
        <button class="filter-btn" data-filter="book">Book</button>
    </div>

    <?php if ($error): ?>
        <div class="status-message error"><?= $error; ?></div>
    <?php else: ?>
        <div class="project-grid">
            <?php if (!$projects): ?>
                <p style="text-align: center; width: 100%; color: #666;">No projects found. Add some via the admin panel.</p>
            <?php else: ?>
                <?php foreach ($projects as $item): ?>
                    <div class="project-card fade-in" data-category="<?= htmlspecialchars($item['category']); ?>">
                        <img src="<?= htmlspecialchars($item['main_image'] ?: 'assets/img/placeholder.png'); ?>" alt="<?= htmlspecialchars($item['title_en']); ?>">
                        <div class="card-body">
                            <h3><?= htmlspecialchars($item['title_' . $lang]); ?></h3>
                            <p><?= htmlspecialchars($item['short_desc_' . $lang]); ?></p>
                            <a href="project-detail.php?id=<?= $item['id']; ?>" class="details-link">View Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<?php include_once 'includes/footer.php'; ?>