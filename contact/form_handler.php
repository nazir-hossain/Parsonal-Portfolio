<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $recipient_email = "your-email@example.com"; // নিজের ইমেইল

    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST["subject"]), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($subject) || empty($message)) {
        header("Location: ../contact.php?status=error");
        exit;
    }

    $email_subject = "New Contact Form Message: " . $subject;
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($recipient_email, $email_subject, $email_body, $headers)) {
        header("Location: ../contact.php?status=success");
    } else {
        header("Location: ../contact.php?status=error");
    }

} else {
    header("Location: ../contact.php");
}
exit;
?>