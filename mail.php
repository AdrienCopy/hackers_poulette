<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Créer une nouvelle instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres du serveur SMTP
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'adrien.copy@gmail.com';
    $mail->Password = 'tcgk jakc gbgz muyn';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Destinataire, sujet et corps du message
    $mail->setFrom('adrien.copy@gmail.com', 'Adrien Copy');
    $mail->addAddress('adrien.boels@gmail.com', 'Adrien Boels');
    $mail->Subject = 'Test Email via PHPMailer';
    $mail->Body = 'This is a test email sent via PHPMailer.';

    // Envoyer l'email
    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
