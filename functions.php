<?php


define('MB',1048576);

// this function a simple method to secure the input fields

function filterRequest($requestname){
    return htmlspecialchars(strip_tags($_POST[$requestname]));
}



function getAllData($table, $where = null, $values = null, $json = true)
{
    global $connect;
    $data = array();
    if($where == null ){
        $stmt = $connect->prepare("SELECT  * FROM $table ");
    }else{
        $stmt = $connect->prepare("SELECT  * FROM $table WHERE   $where ");
    }
    
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();

    if ($json == true ){
        if ($count > 0){
            echo json_encode(array("status" => "success", "data" => $data,"message" => "get all data function done"));
        } else {
            echo json_encode(array("status" => "failure","message" => "failed get all data"));
        }
        return $count;
    }else {
       if($count > 0){
        return $data;
       }else{
        return json_encode(array("status" => "failure","message" => "failed get all data"));
       }
    }


}



function getData($table, $where = null, $values = null)
{
    global $connect;
    $data = array();
    $stmt = $connect->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($count > 0){
        echo json_encode(array("status" => "success", "data" => $data,"message" => "get data function done"));
    } else {
        echo json_encode(array("status" => "failure","message" => "failed get data"));
    }
    return $count;
}















function insertData($table, $data, $json = true)
{
    global $connect;
    foreach ($data as $field => $v)
    {
        $ins[] = ':' . $field;
        $ins = implode(',', $ins);
        $fields = implode(',', array_keys($data));
    }


    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $connect->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success","message" => "success insert data"));
    } else {
        echo json_encode(array("status" => "failure","message" => "failed insert data"));
    }
  }
    return $count;
}





function updateData($table, $data, $where, $json = true)
{
    global $connect;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $connect->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "success","message" => "success updata data"));
    } else {
        echo json_encode(array("status" => "failure","message" => "failed update data"));
    }
    }
    return $count;
}




function deleteData($table, $where, $json = true)
{
    global $connect;
    $stmt = $connect->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success","message" => "success delete data"));
        } else {
            echo json_encode(array("status" => "failure","message" => "failed delete data"));
        }
    }
    return $count;
}





function imageUpload($imageRequest){
    global $msgError;
    $imageName          = rand(100,10000) .  $_FILES[$imageRequest]['name'];
    $imageTmp           = $_FILES[$imageRequest]['tmp_name'];
    $imageSize          = $_FILES[$imageRequest]['size'];
    $allowEXT           = array("jpg","png","gif","webp");
    $strtoarr           = explode(".",$imageName);
    $ext                = strtolower(end($strtoarr));
    if (!empty($imageName) && !in_array($ext,$allowEXT)){
        $msgError[] = "ext not support";
    }
    if ($imageSize > 10 * MB){
        $msgError[] = "size is too big";
    }

    if(empty($msgError)){
        move_uploaded_file($imageTmp,"../upload/" . $imageName);
        // print("file uploaded success");
        return $imageName;
    }else{
        print_r($msgError);
        return "upload faild";
    }
    
}



function deleteFiles($dir,$fileName){
    if(file_exists($dir."/".$fileName)){
        unlink($dir."/".$fileName);
        // print("file deleted success");
    }
}



function sendEmail($to,$subject,$message){

$header = "From: support@hamzawystore.com" . "\n" . " CC: $to";
$header .= "Reply-To: noreply@hamzawystore.com\r\n";
$header .= "Content-Type: text/html; charset=UTF-8\r\n";


mail($to,$subject,$message,$header);

}







?>