<?php
echo 'inside the script';
require 'PHPMailer/PHPMailerAutoload.php';
echo 'file included';
$mail = new PHPMailer;
echo 'instance created';
$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'aditigunjanigdtuw@gmail.com';          // SMTP username
$mail->Password = 'aditigunjan'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('aditigunjanigdtuw@gmail.com', 'Aditi');
$mail->addReplyTo('aditigunjanigdtuw@gmail.com', 'Aditi');
$mail->addAddress('aditinikunj@gmail.com');   // Add a recipient


$mail->isHTML(true);  // Set email format to HTML

$bodyContent = mt_rand(100000, 999999);
$bodyContent .= '<p>This is the HTML email sent from localhost using PHP script</p>';

$mail->Subject = 'Email from Registration System';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>