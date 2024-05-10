
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendMailToContact ($name, $email, $subject, $message, $recipientEmail) {
$mail = new PHPMailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
//$mail->Debugoutput = 'html'; // Output debug messages as HTML
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->CharSet = "utf-8";
$mail->Username   = 'takenoteonline2@gmail.com'; 
$mail->Password = 'pziv tumx ptmj sfey';
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->setFrom($email, $name . ' @ ' . $email);
$mail->addAddress($recipientEmail); //recepient email address

$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $message . '<br>Email address: ' . $email . '<br>Name: ' . $name;
$mail->AltBody = strip_tags($message);

if(!$mail->send()) {
    return "Email not sent. Please try again";
} else {
    return "email sent successfully";
}

}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    /*
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    */
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';
    $recipientEmail = 'lobingcokenneth@gmail.com'; // Replace with organization's email


    // Validate email
    if (!$email) {
        // Handle invalid email address
        exit("Invalid email address.");
    }

    // Debugging: Echo input values to check if they are correct
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Subject: " . $subject . "<br>";
    echo "Message: " . $message . "<br>";
    sendMailToContact($name, $email, $subject, $message, $recipientEmail);
    }
    
?>

