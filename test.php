<?php

// Here the oprations that i'm gonna use is > insert & select <

include "connect.php";

// add request without image


$name           = filterRequest('name') ;
$email          = filterRequest('email');
$phone          = filterRequest('phone');
$password       = filterRequest('password');
$verify         = filterRequest('verify');


    $stmt = $connect->prepare("INSERT INTO `users`(`users_name`, `users_email`, `users_phone`, `users_password`, `users_verifycode`) VALUES
     (?,?,?,?,?)");
    
    
    $stmt->execute(array($name,$email,$phone,$password,$verify));
    
    
    $count = $stmt->rowCount();
    
    
    if($count > 0){
        echo json_encode(array("status" => "add note success"));
    }else{
        echo json_encode(array("status" => "failed add note"));
    }
    
    // $stmt = $connect->prepare("INSERT INTO `notes` (`notes_title`, `notes_content`, `notes_users`) 
    // VALUES (?,?,?)");

    // Here the oprations that i'm gonna use is > insert & select <





?>





    
