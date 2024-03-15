<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

header('Content-Type: application/json'); // Set content type to JSON

if (isset($_POST["send"])) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Configure SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sales@nhkmedical.com'; // Your Gmail email address
        $mail->Password = 'naob zdax vahx oylh'; // Use an app-specific password or secure storage method
        $mail->SMTPSecure = 'ssl'; // Enable SSL encryption
        $mail->Port = 465; // SMTP port (465 for SSL)

        // Set sender and recipient
        $mail->setFrom($_POST["email"]); // Sender's email address
        $mail->addAddress('sales@nhkmedical.com'); // Recipient's email address

        $cc_emails = array('support@nhkmedical.com', 'sanskarsharma0624@gmail.com', 'Pannalal@nhkmedical.com', 'vishnu2022nirmalhealthcare@gmail.com', 'rahulnandi03nirmalhealthcare@gmail.com');
        foreach ($cc_emails as $cc_email) {
            $mail->addCC($cc_email);
        }

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = "Customer contact via website";
        $mail->Body = "
            <html>
            <head>
            <style>
                /* Your existing styles */
            </style>
            </head>
            <body>
            <div class='container'>
            <div class='content'>
            <h2>Contact Information</h2>
            <div class=\"info-item\"><span class=\"info-label\">Name:</span> {$_POST['name']}</div>
            <div class=\"info-item\"><span class=\"info-label\">Email:</span> {$_POST['email']}</div>
            <div class=\"info-item\"><span class=\"info-label\">Mobile Number:</span> {$_POST['phone']}</div>
            <div class=\"info-item\"><span class=\"info-label\">City:</span> {$_POST['city']}</div>
            </div>
            <div class='footer'>
            <p>Thank you for contacting us!</p>
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
            exit;
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit;
    }
}
?>
