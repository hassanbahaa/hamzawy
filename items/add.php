<?php


include "../connect.php";






// I got some errors because "I think" it's because some thing in the API maybe I have recieve or send the data as a json 




$items_name = filterRequest('name');
$items_name_ar = filterRequest('name_ar');
$items_description = filterRequest('description');
$items_description_ar = filterRequest('description_ar');
$items_image = filterRequest('image');
$items_count = filterRequest('count');
$items_active = filterRequest('active');
$items_price = filterRequest('price');
$items_discount = filterRequest('discount');
// items categories cell type is int refernce to categories ID
$items_cat = filterRequest('cat');




//$items_name                         = filterRequest("name");

//$_POST['password']
/*
$items_name = $_POST["name"];
$items_name_ar = $_POST['name_ar'];
$items_description = $_POST['description'];
$items_description_ar = $_POST['description_ar'];
$items_count = $_POST['count'];
$items_active = $_POST['active'];
$items_price = $_POST['price'];
$items_discount = $_POST['discount'];
$items_cat = $_POST['cat'];
*/

//print("ZZZZZZZZZZ " . $_POST['description_ar']);




/*


انا محتاج اعمل api 
مختلف للويب و للآب مينفعش الاتنين يكونوا نفس بعض



*/ 



$inputs = array(

    "name"                => $items_name,
    "name_ar"             => $items_name_ar,
    "description"         => $items_description,
    "description_ar"      => $items_description_ar,
    "image"               => $items_image,
    "count"               => $items_count,
    "active"              => $items_active,
    "price"               => $items_price,
    "discount"            => $items_discount,
    "cat"                 => $items_cat


);








$stmt = $connect->prepare("SELECT * FROM items WHERE items_name = ?  ");
$stmt->execute(array($items_name));

$count = $stmt->rowCount();



if ($count > 0) {
    echo json_encode(array("status" => "already added", "message" => "this product is already used before"));
} else {


    $stmt = $connect->prepare("INSERT INTO `items`(`items_name`, `items_name_ar`, `items_description`, `items_description_ar`,`items_image`, `items_count`,`items_active`,`items_price`,`items_discount`,`items_cat`) VALUES
    (?,?,?,?,?,?,?,?,?,?)");

    $stmt->execute(array($items_name, $items_name_ar, $items_description, $items_description_ar,$items_image, $items_count, $items_active, $items_price, $items_discount, $items_cat));

    $count = $stmt->rowCount();


    if ($count > 0) {
        echo json_encode(array("status" => "add product success", "message" => "successfully added new product"));
    } else {
        echo json_encode(array("status" => "failed add product", "message" => "failed add new product"));
    }

}



?>
