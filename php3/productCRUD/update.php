<?php

// required headers

include_once '../connect/database.php';
include_once '../objects/product.php';

// instantiantating database and product object and accesiing these class through their instance
$database = new Database();

$db = $database->getConnection();

$product = new Product($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$product->id = $data->id;
 
// set product property values
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;
 
// update the product
if($product->update()){
    echo '{';
        echo '"message": "Product was updated."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update product."';
    echo '}';
}



?>