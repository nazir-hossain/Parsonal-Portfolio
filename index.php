<?php 
require_once 'includes/init.php';

// Set page title from language pack
$pageTitle = $lang_pack['page_title_home'];

require_once 'includes/header.php';

// Initialize data containers
$recent_projects = [];
$recent_research = [];
$recent_books = [];

try {
    // Get latest 3 items under project-related categories
    $query1 = "SELECT * FROM projects 
               WHERE category IN ('project', 'php', 'javascript', 'react') 
               ORDER BY created_at DESC LIMIT 3";
    $stmt1 = $pdo->prepare($query1);
    $stmt1->execute();
    $recent_projects = $stmt1->fetchAll();

    // Get latest 2 research papers
    $query2 = "SELECT * FROM projects 
               WHERE category = 'research' 
               ORDER BY created_at DESC LIMIT 2";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->execute();
    $recent_research = $stmt2->fetchAll();

    // Get latest 2 books/publications
    $query3 = "SELECT * FROM projects 
               WHERE category = 'book' 
               ORDER BY created_at DESC LIMIT 2";
    $stmt3 = $pdo->prepare($query3);
    $stmt3->execute();
    $recent_books = $stmt3->fetchAll();

} catch (PDOException $ex) {
    // Instead of halting the page, log error silently for homepage
    $db_error = true;
}
?>

<!-- Hero Section -->
<section class="hero-section reveal-on-scroll">
    <div class="hero-text">
        <h1><?= $lang_pack['hero_title']; ?></h1>
        <h2><?= $lang_pack['hero_subtitle']; ?></h2>
        <p><?= $lang_pack['hero_description']; ?></p>
        <a href="projects.php" class="cta-button"><?= $lang_pack['hero_button']; ?></a>
    </div>
    <div class="hero-image">
        <img src="assets/img/profile.jpg" alt="Photo of MD Nazir Hossain">
    </div>
</section>

<!-- Recent Projects -->
<?php if (!empty($recent_projects)): ?>
<section class="homepage-section reveal-on-scroll">
    <h2>Recent Projects</h2>
    <div class="project-grid">
        <?php foreach ($recent_projects as $item): ?>
            <div class="project-card">
                <img src="<?= htmlspecialchars($item['main_image'] ?? 'assets/img/placeholder.png'); ?>" alt="<?= htmlspecialchars($item['title_en']); ?>">
                <div class="card-content">
                    <h3><?= htmlspecialchars($item['title_' . $lang]); ?></h3>
                    <p><?= htmlspecialchars($item['short_desc_' . $lang]); ?></p>
                    <div class="project-links">
                        <a href="project-detail.php?id=<?= $item['id']; ?>" class="details-link">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- Recent Research Papers -->
<?php if (!empty($recent_research)): ?>
<section class="homepage-section reveal-on-scroll">
    <h2>Recent Research</h2>
    <div class="project-grid">
        <?php foreach ($recent_research as $item): ?>
            <div class="project-card">
                <img src="<?= htmlspecialchars($item['main_image'] ?? 'assets/img/placeholder.png'); ?>" alt="<?= htmlspecialchars($item['title_en']); ?>">
                <div class="card-content">
                    <h3><?= htmlspecialchars($item['title_' . $lang]); ?></h3>
                    <p><?= htmlspecialchars($item['short_desc_' . $lang]); ?></p>
                    <div class="project-links">
                        <a href="project-detail.php?id=<?= $item['id']; ?>" class="details-link">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- Recent Books -->
<?php if (!empty($recent_books)): ?>
<section class="homepage-section reveal-on-scroll">
    <h2>Books / Publications</h2>
    <div class="project-grid">
        <?php foreach ($recent_books as $item): ?>
            <div class="project-card">
                <img src="<?= htmlspecialchars($item['main_image'] ?? 'assets/img/placeholder.png'); ?>" alt="<?= htmlspecialchars($item['title_en']); ?>">
                <div class="card-content">
                    <h3><?= htmlspecialchars($item['title_' . $lang]); ?></h3>
                    <p><?= htmlspecialchars($item['short_desc_' . $lang]); ?></p>
                    <div class="project-links">
                        <a href="project-detail.php?id=<?= $item['id']; ?>" class="details-link">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>