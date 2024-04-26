<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_SESSION['abhimali656@gmail.com']; // Use email from session
        $mail->Password = $_SESSION['artu qhry dwgw vqxx']; // Use password from session

        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($_SESSION['abhimali656@gmail.com']); // Use email from session
        $mail->addAddress($_POST["to"]);
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];
        $mail->Body = $_POST["message"];
        $mail->send();

        // Display success message
        echo "
        <script>
            alert('Email sent successfully.');
            window.location.href = 'index.php';
            document.write('Email Successfully sent');
        </script>";
    } catch (Exception $e) {
        echo "Failed to send email: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
