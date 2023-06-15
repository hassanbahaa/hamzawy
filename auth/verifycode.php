<?php

include "../connect.php";

$email = filterRequest("email") ;


$verify = filterRequest("verifycode");


$stmt = $connect->prepare("SELECT * FROM `users` WHERE `users_email` = '$email' AND `users_verifycode` = '$verify' ");

$stmt->execute();


$count = $stmt->rowCount();

if($count > 0){

    $data = array("users_approve" => "1");

    updateData("users",$data," `users_email` = '$email' ");
    // the line below will make an issue because update dataf function already has an echo function
    //echo json_encode(array("status" => "verify success"));

}else {

  echo json_encode(array("status" => "wrong verify code","message" => "wrong verify code or wrong email"));

}








?>
