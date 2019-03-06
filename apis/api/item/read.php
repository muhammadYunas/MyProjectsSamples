<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Item.php';

// Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

// Instantiate blog post object
$item = new Item($db);

// Blog item query
$result = $item->read();

// Get row count
$num = $result->rowCount();

// Check if any item

if($num > 0){
  // item array
  $item_arr = array();
  $item_arr['data'] = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $item_item = array(
      'id' => $id,
      'title' => $title,
      'description' => html_entity_decode($description),
      'img' => $img,
      'category_id' => $category_id,
      'author' => $author,
      'created_at' => $created_at,
      'category_name' => $category_name
    );

    // Push to "data"
    array_push($item_arr['data'], $item_item);
  }

  // Turn to JSON & output
  echo json_encode($item_arr);


} else {
  // No Posts
  echo json_encode(
    array('message' => 'No Posts Found')
  );
}