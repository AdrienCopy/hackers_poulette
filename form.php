<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bellota:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <title>Hackers Poulette</title>
</head>
<body style="font-family: 'Bellota', system-ui;
  font-weight: 300;
  font-style: normal;">
<header>
        <br>
        <h1 class="text-center">Hackers Poulette</h1>
    </header>
    <main>
        <img src="./assets/picture/logo.png" class="rounded mx-auto d-block" alt="logo">
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
    
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$name = "";
$gender = "";
$email = "";
$country = "";
$subject = "";
$message = "";

function validateEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    } else {
        return false;
    }
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['control']) && $_POST['control'] != '') {
        die("Error: Suspicious activity detected.");
    }
    if (isset($_POST['name_Lastname']) 
        && isset($_POST['gender']) 
        && isset($_POST['email']) 
        && isset($_POST['country']) 
        && isset($_POST['subject']) 
        && isset($_POST['message'])) {
        
        $name = sanitizeInput($_POST['name_Lastname']);
        $gender = sanitizeInput($_POST['gender']);
        $email = sanitizeInput($_POST['email']);
        $country = sanitizeInput($_POST['country']);
        $subject = sanitizeInput($_POST['subject']);
        $message = sanitizeInput($_POST['message']);
       
        #print_r ($name . $gender . $email . $country . $subject . $message);
        $validatedEmail = validateEmail($email);
        if ($validatedEmail !== false) {
            $email = $validatedEmail;

            $mail = new PHPMailer(true);

            try {
                // Paramètres du serveur SMTP
                #$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'mail@gmail.com';
                $mail->Password = 'password';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->isHTML(true);
                
                // Destinataire, sujet et corps du message
                $mail->setFrom('mail@gmail.com', 'name);
                $mail->addAddress($email, $name);
                $mail->Subject = 'Hello ' . $name;
                $mail->Body = '
                    <div style="border: 1px solid #ccc; border-radius: 15px; padding: 20px; background-color: #0d8187;">
                    <h1 style="color: rgb(253, 0, 0);">Hello ' . $name . '</h1>
                    <div style="color: rgb(255, 255, 255);">
                    <p>We have received your subject: ' . $subject . '.</p>
                    <p>As a reminder : <br>' . $message . '</p>
                    </div>
                    <div style="color: rgb(165, 0, 0); margin-top: 20px;">
                        <p>This is an automated message. Please do not reply.</p>
                    </div>
                    </div>';

                // Envoyer l'email
                $mail->send();
                echo '<h2 class="text-center">Email sent successfully</h2>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $errorMessage = "Votre email est invalide. Veuillez entrer une adresse email valide.";
            echo "<span id='email-error' style='color: red;'>$errorMessage</span>";
        }
    } else {
        echo "Tous les champs ne sont pas définis.";
    }
} 
?>

</body>
</html>
