<?php

include "functions.php";

//id20733854_
//Hh%240407
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


} catch (PDOException $e) {
    //throw $th;
    echo "Error from connect file " . $e->getMessage();
}








?>