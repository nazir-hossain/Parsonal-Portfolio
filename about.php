<?php
include_once 'includes/init.php';
$pageTitle = $lang_pack['page_title_about'];

include_once 'includes/header.php';
?>

<section class="content-section reveal-on-scroll">
    <h1><?= $lang_pack['about_title']; ?></h1>

    <p><?= $lang_pack['about_p1']; ?></p>
    <p><?= $lang_pack['about_p2']; ?></p>

    <h2><?= $lang_pack['about_skills_title']; ?></h2>
    <ul class="skill-list">
        <li>HTML5 and CSS3 – Responsive Layouts</li>
        <li>Modern JavaScript (ES6+)</li>
        <li>PHP (Vanilla PHP & Laravel Framework)</li>
        <li>Relational Databases – MySQL</li>
        <li>RESTful APIs and basic CRUD logic</li>
        <li>Git, GitHub and Team Collaboration</li>
    </ul>
</section>

<?php include_once 'includes/footer.php'; ?>