<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    $mail = new PHPMailer(true);
    try {
        // Server settings (use your SMTP)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mstprivatelimited@gmail.com';  // Your Gmail
        $mail->Password = 'rova bcyj ecpf vtzl';             // App Password (not regular)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('mstprivatelimited@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact: $name";
        $mail->Body = "<h3>New Message</h3><p><strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Message:</strong><br>$message</p>";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Thank you! We\'ll respond soon.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send. Try again.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>