<?php

// how to send email to users

$to = "hassanbahaa45@gmail.com";
$subject = "activate account";
$message = "Welcome to our community";
$header = "From: support@hamzawystore.com" . "\n" . " CC: hassan@gmail.com";


mail($to,$subject,$message,$header);

echo "I'm about to learn PHP!<br>";


?>