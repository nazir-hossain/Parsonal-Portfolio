<?php
// ডাটাবেসের তথ্য এখানে নিজের মতো করে লিখো
define('DB_HOST', 'localhost'); // ডাটাবেস হোস্ট সাধারণত localhost 'ই হয়
define('DB_NAME', 'your_database_name'); // এখানে আপনার ডাটাবেসের নাম দিন
define('DB_USER', 'your_database_user'); // এখানে আপনার ডাটাবেস ইউজার দিন
define('DB_PASS', 'your_database_password'); // এখানে আপনার ডাটাবেস পাসওয়ার্ড দিন

// PDO দিয়ে ডাটাবেসের সাথে সংযোগ তৈরি করা হচ্ছে
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    
    // যদি কোনো সমস্যা হয়, তাহলে যেন error দেখায়
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ডাটাবেস থেকে ডেটা আনার সময় array আকারে পেতে চাইলে নিচের লাইনটি দরকার
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // যদি ডাটাবেসে কানেকশন না হয়, তাহলে স্ক্রিপ্ট বন্ধ হয়ে যাবে এবং error দেখাবে
    die("ডাটাবেসে সংযোগ করা যাচ্ছে না। বিস্তারিত: " . $e->getMessage());
}
?>