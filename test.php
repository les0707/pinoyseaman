<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // SMTP Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';         // SMTP server (Gmail)
    $mail->SMTPAuth = true;                 // Enable SMTP authentication
    $mail->Username = 'esclanda97@gmail.com'; // Your Gmail address
    $mail->Password = 'vfqm lavl njrx hiqr';  // Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
    $mail->Port = 587;                      // TCP port for SMTP

    // Email settings
    $mail->setFrom('esclanda97@gmail.com', 'PinoySeaman');
    $mail->addAddress('esclandaleigh@gmail.com', 'User Name'); // Recipient's email
    $mail->addReplyTo('esclanda97@gmail.com', 'PinoySeaman');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Welcome to PinoySeaman';
    $mail->Body    = '<h1>Welcome to PinoySeaman</h1><p>Your account has been created successfully.</p>';

    // Send the email
    $mail->send();
    echo 'Email has been sent successfully!';
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
