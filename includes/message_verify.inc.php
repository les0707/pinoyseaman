<?php
session_start();

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = sanitize_input($_POST["name"]);
$email = sanitize_input($_POST["email"]);
$contact = sanitize_input($_POST["contact"]);
$message = sanitize_input($_POST["message"]);

if (empty($name)) {
    $link = "../contact.php";
    $message = "<font color='red'>Name is required!</font>";
    include "../action.php";
    exit;
}

if (empty($email)) {
    $link = "../contact.php";
    $message = "<font color='red'>Email is required!</font>";
    include "../action.php";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $link = "../contact.php";
    $message = "<font color='red'>Email is invalid!</font>";
    include "../action.php";
    exit;
}

if (empty($contact)) {
    $link = "../contact.php";
    $message = "<font color='red'>Contact is required!</font>";
    include "../action.php";
    exit;
}

if (strpos($contact, '@') !== false) {
    include "../index.php";
    exit;
}

if (empty($message)) {
    $link = "../contact.php";
    $message = "<font color='red'>Message is required!</font>";
    include "../action.php";
    exit;
}

if (preg_match('/http:\/\/|https:\/\/|Ð/', $message)) {
    include "../index.php";
    exit;
}

$headers = 'From: PinoySeaman <info@pinoyseaman.com>' . "\r\n" .
    'Reply-To: PinoySeaman <info@pinoyseaman.com>' . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$email_message = "
<font face='verdana' size='2'>
Message from website (v2)
<br><br>
Name: $name 
<br>
Email: $email
<br>
Contact Number: $contact
<br>
Message: $message
</font>";

mail("admin@pinoyseaman.com", "Message", $email_message, $headers);

$link = "../contact.php";
$message = "<font color='blue'>Thank you for sending us the message!!! We will get back to you shortly.....</font>";
include "../action.php";
exit;
?>
