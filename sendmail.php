<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer
// OR
// require 'phpmailer/src/PHPMailer.php';
// require 'phpmailer/src/Exception.php';
// require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';         // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'krunalbaldha1@gmail.com';   // Your email
        $mail->Password = 'cxheodzitnnypyef';      // App password (not Gmail login)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom($email, $name);
        $mail->addAddress('your-email@gmail.com'); // Your receiving email

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Message: $subject";
        $mail->Body = "
            <h3>New Message from Contact Form</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        echo "✅ Your message has been sent successfully!";
    } catch (Exception $e) {
        echo "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
