
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendMailToContact ($name, $email, $subject, $message) {
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'takenoteonline2@gmail.com';
$mail->Password = 'aebp guya dojt yukt';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port = 465;

$mail->setFrom('takenoteonline2@gmail.com', "Plexus Technology Corporation");
$mail->addAddress(''); //recepient email address

$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $message;
$mail->AltBody = strip_tags($message);;
$mail->send();
echo 'Email successfully sent';

}

if($_SERVER["REQUEST_METHOD"] == "POST") {
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

sendMailToContact($name, $email, $subject, $message);
}

?>

