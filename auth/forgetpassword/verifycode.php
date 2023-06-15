<?php

include "../../connect.php";


$email = filterRequest("email") ;


$verify = filterRequest("verifycode");


$stmt = $connect->prepare("SELECT * FROM `users` WHERE `users_email` = '$email' AND `users_verifycode` = '$verify' ");

$stmt->execute();


$count = $stmt->rowCount();

if($count > 0){

  echo json_encode(array("status" => "correct verify code","message" => "correct verify code for reset password"));
}else {

  echo json_encode(array("status" => "wrong verify code","message" => "wrong verify code or wrong email"));

}








?>
