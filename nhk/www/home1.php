<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

header('Content-Type: application/json'); // Set content type to JSON

if(isset($_POST["send1"])){
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    // Configure SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sales@nhkmedical.com'; // Your Gmail email address
    $mail->Password = 'naob zdax vahx oylh'; // Use an app-specific password or secure storage method
    $mail->SMTPSecure = 'ssl'; // Enable SSL encryption
    $mail->Port = 465; // SMTP port (465 for SSL)

    // Set sender and recipient
    $mail->setFrom('sales@nhkmedical.com'); // Fixed sender's email address
    $mail->addAddress('sales@nhkmedical.com'); // Recipient's email address

    $cc_emails = array('support@nhkmedical.com','sanskarsharma0624@gmail.com', 'Pannalal@nhkmedical.com', 'vishnu2022nirmalhealthcare@gmail.com','rahulnandi03nirmalhealthcare@gmail.com');
    foreach($cc_emails as $cc_email) {
        $mail->addCC($cc_email);
    }

    // Set email content
    $mail->isHTML(true);
    $mail->Subject = "Arrange A Call Back Request";
    $mail->Body = "
<html>
<head>
<style>
    body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; }
    .container { width: 100%; max-width: 650px; margin: 20px auto; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    .header { background-color: #ffffff; padding: 20px; text-align: center; }
    .header img { height: 50px; }
    .footer { background-color: #f8f9fa; padding: 15px; text-align: center; font-size: 14px; color: #666; }
    .content { padding: 30px; line-height: 1.6; }
    .content h2 { color: #007bff; }
    .button {
        background-color: #28a745;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
        margin: 15px 0;
        cursor: pointer;
    }
    .info-item { margin-bottom: 10px; }
    .info-label { font-weight: bold; }
</style>
</head>
<body>
<div class='container'>
    <div class='content'>
        <h2>Call Back Request Information</h2>
        <div class=\"info-item\"><span class=\"info-label\">Name:</span> {$_POST['name']}</div>
        <div class=\"info-item\"><span class=\"info-label\">Phone:</span> {$_POST['phone']}</div>
        <div class=\"info-item\"><span class=\"info-label\">Pincode:</span> {$_POST['pincode']}</div>
    </div>
    <div class='footer'>
        <p>A user has requested a call back!</p>
    </div>
</div>
</body>
</html>
    ";

    if ($mail->send()) {  
        header('Location: success.html');
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
    }
}
?>
