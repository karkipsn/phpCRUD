<?php

// required headers

include_once '../connect/database.php';
include_once '../objects/product.php';

// instantiantating database and product object and accesiing these class through their instance
$database = new Database();

$db = $database->getConnection();

$product = new Product($db);
// get product id
$data = json_decode(file_get_contents("php://input"));
 
// set product id to be deleted
$product->id = $data->id;
 
// delete the product
if($product->delete()){
    echo '{';
        echo '"message": "Product was deleted."';
    echo '}';
}
 
// if unable to delete the product
else{
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}


?>