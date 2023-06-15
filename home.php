<?php


include "connect.php";




$alldata = array();


$categories = getAllData("categories", null, null, false);

$alldata['status'] = "success";
$alldata['categories'] = $categories;



$items = getAllData("itemsview", "items_discount != 0", null, false);

$alldata['items'] = $items;






echo json_encode($alldata);







?>