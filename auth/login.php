<?php

include "../connect.php";


$email          = filterRequest('email');
// $password       = filterRequest('password');
$password       = sha1($_POST['password']);


//$stmt = $connect->prepare("SELECT * FROM users WHERE users_email = ? AND users_password = ? " );

//$stmt->execute(array($email,$password));

//$count = $stmt->rowCount();


getData("users","users_email = ? AND users_password = ?",array($email,$password)); 




/*

if($count > 0){
    echo json_encode(array("status" => "Sign in successfully","message" => "success sign in"));
}else{

    echo json_encode(array("status" => "Sign in failed","message" => "failed sign in"));

}
*/


?>