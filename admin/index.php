<?php 
$page_title = 'Dashboard';
include 'partials/header.php'; 
include '../includes/db_connect.php';

// আজকের ভিজিটর সংখ্যা
$sql_today = "SELECT COUNT(DISTINCT ip_address) FROM visitors WHERE DATE(visit_date) = CURDATE()";
$stmt_today = $pdo->query($sql_today);
$today_visitors = $stmt_today ? $stmt_today->fetchColumn() : "N/A";

// গতকালের ভিজিটর সংখ্যা
$sql_yesterday = "SELECT COUNT(DISTINCT ip_address) FROM visitors WHERE DATE(visit_date) = CURDATE() - INTERVAL 1 DAY";
$stmt_yesterday = $pdo->query($sql_yesterday);
$yesterday_visitors = $stmt_yesterday ? $stmt_yesterday->fetchColumn() : "N/A";

// এই মাসের ভিজিটর সংখ্যা
$sql_month = "SELECT COUNT(DISTINCT ip_address) FROM visitors WHERE MONTH(visit_date) = MONTH(CURDATE()) AND YEAR(visit_date) = YEAR(CURDATE())";
$stmt_month = $pdo->query($sql_month);
$month_visitors = $stmt_month ? $stmt_month->fetchColumn() : "N/A";

// এই বছরের ভিজিটর সংখ্যা
$sql_year = "SELECT COUNT(DISTINCT ip_address) FROM visitors WHERE YEAR(visit_date) = YEAR(CURDATE())";
$stmt_year = $pdo->query($sql_year);
$year_visitors = $stmt_year ? $stmt_year->fetchColumn() : "N/A";

// প্রজেক্ট সংখ্যা
$sql_projects = "SELECT COUNT(*) FROM projects";
$stmt_projects = $pdo->query($sql_projects);
$project_count = $stmt_projects ? $stmt_projects->fetchColumn() : 0;
?>

<h1>Dashboard</h1>
<p>আপনার সাইটের সারসংক্ষেপ নিচে দেওয়া হলো।</p>

<div>
    <h4>আজকের ভিজিটর</h4>
    <p><?php echo $today_visitors; ?></p>
</div>
<div>
    <h4>গতকালের ভিজিটর</h4>
    <p><?php echo $yesterday_visitors; ?></p>
</div>
<div>
    <h4>এই মাসের ভিজিটর</h4>
    <p><?php echo $month_visitors; ?></p>
</div>
<div>
    <h4>এই বছরের ভিজিটর</h4>
    <p><?php echo $year_visitors; ?></p>
</div>

<div>
    <h3>প্রজেক্ট সংখ্যা</h3>
    <p>মোট প্রজেক্ট: <?php echo $project_count; ?></p>
    <p><a href="manage_projects.php">প্রজেক্ট ম্যানেজ করুন</a></p>
</div>

<div>
    <h3>মিডিয়া লাইব্রেরি</h3>
    <p>আপলোড করা ছবি ও ফাইল গুলো ম্যানেজ করুন।</p>
    <p><button disabled>মিডিয়া লাইব্রেরি আসছে শীঘ্রই</button></p>
</div>

<?php include 'partials/footer.php'; ?>