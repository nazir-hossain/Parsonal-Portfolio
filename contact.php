<?php
include_once 'includes/init.php';
$pageTitle = $lang_pack['page_title_contact'];

include_once 'includes/header.php';
?>

<section class="content-section reveal-on-scroll">
    <h1><?= $lang_pack['contact_title']; ?></h1>
    <p><?= $lang_pack['contact_description']; ?></p>

    <?php
    if (!empty($_GET['status'])) {
        if ($_GET['status'] === 'success') {
            echo '<div class="status-message success">Thanks! Your message has been sent successfully.</div>';
        } else {
            echo '<div class="status-message error">Oops! Something went wrong. Please try again.</div>';
        }
    }
    ?>

    <form id="contact-form" action="contact/form-handler.php" method="POST" autocomplete="off">
        <div class="form-group">
            <label for="name">Name<span>*</span></label>
            <input type="text" name="name" id="name" required placeholder="Enter your full name">
        </div>

        <div class="form-group">
            <label for="email">Email<span>*</span></label>
            <input type="email" name="email" id="email" required placeholder="your@email.com">
        </div>

        <div class="form-group">
            <label for="subject">Subject<span>*</span></label>
            <input type="text" name="subject" id="subject" required placeholder="What’s this about?">
        </div>

        <div class="form-group">
            <label for="message">Your Message<span>*</span></label>
            <textarea name="message" id="message" rows="6" required placeholder="Type your message here..."></textarea>
        </div>

        <button type="submit" class="cta-button">Submit</button>
    </form>
</section>

<?php include_once 'includes/footer.php'; ?>