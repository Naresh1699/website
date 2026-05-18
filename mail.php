<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // SMTP config
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';    // Change using another provider
        $mail->SMTPAuth   = true;
        $mail->Username   = 'yourgmail@gmail.com';      //  your Gmail
        $mail->Password   = 'your-app-password';        //  gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender & Recipient
        $mail->setFrom('yourgmail@gmail.com', 'Contact Form');
        $mail->addAddress('paradisebeachresort.in@gmail.com');      //  your email

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Name: $name\nEmail: $email\nMessage:\n$message";

        $mail->send();
        http_response_code(200);
        echo "Mail sent successfully.";
    } catch (Exception $e) {
        http_response_code(500);
        echo "Mail sending failed: {$mail->ErrorInfo}";
    }
}
