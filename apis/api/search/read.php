<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Search.php';

// Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

// Instantiate blog post object
$search = new Search($db);

// Get raw search data
$data = json_decode(file_get_contents("php://input"));

$search->title        = $data->title;

// Blog search query
$result = $search->read();

// Get row count
$num = $result->rowCount();

// Check if any search

if($num > 0){
  // search array
  $search_arr = array();
  $search_arr['data'] = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $search_arr = array(
      'id' => $id,
      'title' => $title,
      'description' => html_entity_decode($description),
      'img' => $img,
      'category_id' => $category_id,
      'author' => $author,
      'created_at' => $created_at,
      'author_name' => $author_name,
      'category_name' => $category_name
    );

    // Push to "data"
    array_push($search_arr['data'], $search_arr);
  }

  // Turn to JSON & output
  echo json_encode($search_arr);


} else {
  // No Posts
  echo json_encode(
    array('message' => 'No Posts Found')
  );
}