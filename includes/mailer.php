<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__ . "/../vendor/autoload.php";
    $mail = new PHPMailer(true);

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output

    $mail->isSMTP();
    $mail->SMTPAuth = true;


    $mail->Host = "smtp.gmail.com"; // Replace with your SMTP server
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; // Replace with your SMTP port
    $mail->Username = "trinidadryan113@gmail.com"; // Replace with your SMTP username
    $mail->Password = 'dkhy hgva hfwe lytn'; // Replace with your SMTP password

    $mail->isHTML(true);

    return $mail;
?>