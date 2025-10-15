<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Log to file (demo - replace with SQL insert)
    $log = date('Y-m-d H:i:s') . " - Name: $name, Email: $email, Message: $message\n";
    file_put_contents('contacts.log', $log, FILE_APPEND);
    
    // Send email (configure SMTP in php.ini or use PHPMailer)
    $to = 'mtinnovateofficial@gmail.com';
    $subject = 'New Contact Form Submission';
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";
    
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['status' => 'success', 'message' => 'Thank you! We\'ll respond soon.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>