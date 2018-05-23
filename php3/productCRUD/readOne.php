<?php

// instantiantating database and product object
// include database and object files
include_once '../connect/database.php';
include_once '../objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// set ID property of product to be edited
$product->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$product->readOne();

// create array
$product_arr = array(
	"id" =>  $product->id,
	"name" => $product->name,
	"description" => $product->description,
	"price" => $product->price,
	"category_id" => $product->category_id,
	"category_name" => $product->category_name
	
);

// make it json format
echo(json_encode($product_arr));
?>