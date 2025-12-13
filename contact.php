<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = trim($_POST['message']);

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2;                      // Enable verbose debug
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mstprivatelimited@gmail.com';
        $mail->Password   = 'rova bcyj ecpf vtzl';   // 16-digit
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('mstprivatelimited@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = "Contact: $name";
        $mail->Body    = "<h3>Name:</h3> $name <br><h3>Email:</h3> $email <br><h3>Message:</h3> $message";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Sent!']);
    } catch (Exception $e) {
        // LOG ERROR
        error_log("PHPMailer Error: " . $mail->ErrorInfo);
        echo json_encode(['status' => 'error', 'message' => 'Failed: ' . $mail->ErrorInfo]);
    }
}
?>