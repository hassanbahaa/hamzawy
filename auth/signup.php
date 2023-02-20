<?php

include "../connect.php";


$name           = filterRequest('name') ;
$email          = filterRequest('email');
$phone          = filterRequest('phone');
$password       = filterRequest('password');
$verify         = filterRequest('verify');

$stmt = $connect->prepare("SELECT * FROM users WHERE users_email = ? OR users_phone = ? " );

$stmt->execute(array($email,$phone));

$count = $stmt->rowCount();


if($count > 0){
    echo json_encode(array("status" => "you already had an account with this email or phone, sign in"));
}else{

    $stmt = $connect->prepare("INSERT INTO `users`(`users_name`, `users_email`, `users_phone`, `users_password`, `users_verifycode`) VALUES
    (?,?,?,?,?)");
   
   $stmt->execute(array($name,$email,$phone,$password,$verify));

   $count = $stmt->rowCount();
    
    
   if($count > 0){
       echo json_encode(array("status" => "sign up success"));
   }else{
       echo json_encode(array("status" => "failed sign up"));
   }
   
}



?>