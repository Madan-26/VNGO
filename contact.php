<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Subject: $subject\n";
    $body .= "Message:\n$message";
    $to = "madandvg26@gmail.com";
    $headers = "From: $email";
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for your message! We will get back to you shortly.";
    } else {
        echo "Oops! An error occurred while sending your message.";
    }
}
?>
