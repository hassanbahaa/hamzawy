<?php

// how to send email to users
$verify = 44515;
$to = "ahmedcapo012@gmail.com";
$subject = "activate account";
$message = '<html><body>';
$message .= '<p>Dear $name,</p>';
$message .= '<p>Thank you for registering with our app
. Your verification code is:</p>';
$message .= '<h1>' . $verify . '</h1>';
$message .= '<p>Please enter this code on our app to verify your account.</p>';
$message .= '<p>If you did not sign up for our service, please ignore this email.</p>';
$message .= '<p>Thank you,</p>';
$message .= '<p>The Hamzawy store Team</p>';
$message .= '</body></html>';




$header = "From: support@hamzawystore.com" . "\n" . " CC: hassan@gmail.com";

$header .= "Reply-To: noreply@yourcompany.com\r\n";
$header .= "Content-Type: text/html; charset=UTF-8\r\n";



mail($to,$subject,$message,$header);

echo "Hi $to ^^";


?>