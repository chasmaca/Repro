<?php


require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP

$mail->Host = 'smtp.eneasp.com';						  // Specify main and backup SMTP servers

$mail->SMTPAuth = true;                               // Enable SMTP authentication

$mail->Username = 'apps@eneasp.com';                 // SMTP username

$mail->Password = 'AppsEneasp15!';                           // SMTP password

$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'apps@eneasp.com';

$mail->FromName = 'Eneasp';

$mail->addAddress('apps@eneasp.com', 'Joe User');     // Add a recipient


$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';

$mail->Body    = 'This is the HTML message body <b>in bold!</b>';

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {

	echo 'Message could not be sent.';

	echo 'Mailer Error: ' . $mail->ErrorInfo;

} else {

	echo 'Message has been sent';
}

?>