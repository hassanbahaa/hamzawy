<?php

include "functions.php";


$dsn            = "mysql:host=localhost;dbname=hamzawy";
$user           = "root";
$pass           = "";
$option         = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8" // to support arabic
);


try {
    //code...
    $connect = new PDO($dsn,$user,$pass,$option);

    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
    header("Access-Control-Allow-Methods: POST, OPTIONS , GET");
    // echo "Connected";

} catch (PDOException $e) {
    //throw $th;
    echo "Error " . $e->getMessage();
}








?>