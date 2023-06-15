<?php

include "../../connect.php";

$email          = filterRequest('email');



$stmt = $connect->prepare("SELECT * FROM users WHERE users_email = ?  " );

$stmt->execute(array($email));

$count = $stmt->rowCount();


$mydata = $stmt->fetchAll(PDO::FETCH_ASSOC);

$name = $mydata[0]["users_name"];



// $password       = filterRequest('password');
//$password       = sha1($_POST['password']);
$verify         = rand(10000,99999);
$subject        = "Reset Your Password";
// $verifyMessage  = "Please verify your account using this code: $verify";


$message = '<html><body>';
$message .= '<p>Dear '. $name.',</p>';
$message .= '<p>We have received a request to reset the password associated with your account. If you did not make this request, please ignore this message.</p>';
$message .= '<p>To reset your password, please use the verification code below:</p>';
$message .= '<h1>' . $verify . '</h1>';
$message .= '<p>Please enter this code on the password reset screen to verify your identity and reset your password.</p>';
$message .= '<p>Please note that this code will only be valid for a limited time. If you do not reset your password within this time frame, you will need to request a new verification code.</p>';
$message .= '<p>If you have any questions or concerns, please contact our support team at support@hamzawystore.com.</p>';
$message .= '<p>Thank you,</p>';
$message .= '<p>The Hamzawy store Team</p>';
$message .= '</body></html>';






echo $message;

if($count > 0){
    //check if the email is exist , if the email not found the api will send special response to show that the email not found 
    //echo json_encode(array("status" => "found"));  can't use this here because will make a problem with the api response from the update function
    $data = array("users_verifycode" => $verify );
    updateData("users",$data," `users_email` = '$email' ");
    
    
    //sendEmail($email,$subject,$message);
}else{

    echo json_encode(array("status" => "not found","message" => "you do not have an account with this email"));

}



?>