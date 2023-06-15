<?php

include "../connect.php";


$name           = filterRequest('name');
$email          = filterRequest('email');
$phone          = filterRequest('phone');
$password       = sha1($_POST['password']);
$verify         = rand(10000,99999);
$subject        = "Verify Your Account";
// $verifyMessage  = "Please verify your account using this code: $verify";


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



$stmt = $connect->prepare("SELECT * FROM users WHERE users_email = ? OR users_phone = ? " );

$stmt->execute(array($email,$phone));

$count = $stmt->rowCount();


if($count > 0){
    echo json_encode(array("status" => "already used","message" => "this account or phone number is already used before"));
}else{

    $stmt = $connect->prepare("INSERT INTO `users`(`users_name`, `users_email`, `users_phone`, `users_password`, `users_verifycode`) VALUES
    (?,?,?,?,?)");
   
   $stmt->execute(array($name,$email,$phone,$password,$verify));
   sendEmail($email,$subject,$message);

   $count = $stmt->rowCount();
    
    
   if($count > 0){
       echo json_encode(array("status" => "sign up success","message" => "successfully sign up new account"));
   }else{
       echo json_encode(array("status" => "failed sign up","message" => "failed sign up new account"));
   }
   
}



?>