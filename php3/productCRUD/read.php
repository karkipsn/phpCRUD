<?php

// required headers

include_once '../connect/database.php';
include_once '../objects/product.php';

// instantiantating database and product object
$database = new Database();

$db = $database->getConnection();

$product = new Product($db);

$stmt= $product->read();

$num = $stmt->rowCount();

if($num>0){
 // products array
    $products_arr=array();
    $products_arr["records"]=array();

// retrieve our table contents
    // fetch() is faster than fetchAll()
    //Fetch our result as an associative array.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    	// extract row
        // this will make $row['name'] to just $name only

        extract($row);

        $product_item=array("id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name);

        array_push($products_arr["records"],$product_item);
    }
    //Echo the $results array in a JSON format so that we can
//easily handle the results with JavaScript / JQuery
     echo json_encode($products_arr);

 }
else
 {
	echo json_encode(
        array("message" => "No products found.")
    );
}

?>