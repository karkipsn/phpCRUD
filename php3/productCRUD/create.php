<?php

// required headers

include_once '../connect/database.php';
include_once '../objects/product.php';

// instantiantating database and product object and accesiing these class through their instance
$database = new Database();

$db = $database->getConnection();

$product = new Product($db);
//to get a posted data
$data = json_decode(file_get_contents("php://input"));
//To receive RAW post data in PHP, you can use the php://input stream like so:

// set product property values
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;
$product->created = date('Y-m-d H:i:s');

if($product->create()){
	 echo '{';
        echo '"message": "Product was created."';
    echo '}';

}else{
	echo '{';
        echo '"message": "Unable to create product."';
    echo '}';
}

?>