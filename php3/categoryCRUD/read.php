<?php

include_once '../connect/database.php';
include_once '../objects/category.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);

// stmt variable is query stament variable
$stmt= $category->read();

$num = $stmt->rowCount();

if($num>0){
	//define array 
	    // products array
    $categories_arr=array();
    $categories_arr["records"]=array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
        // this will make $row['name'] to
        // just $name only
    	extract($row);

      $category_item=array("id" => $id, 
      	"name"=>$name, 
      	"description" =>html_entity_decode($description ) 
      );

 
    array_push($categories_arr["records"], $category_item);
    }
 
    echo json_encode($categories_arr);
}
else{
	echo json_encode(array("message" => "No products found."));
}

?>