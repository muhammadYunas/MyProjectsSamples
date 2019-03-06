<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-with');

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

/// search read query

// Get row count
// $num = $result->rowCount();

// Check if any searchs

if($result = $search->search()){
  // Cat array
  $search_arr = array();
  $search_arr['data'] = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $search_item = array(
      'id' => $id,
      'title' => $title
    );

    // Push to "data"
    array_push($search_arr['data'], $search_item);
  }

  // Turn to JSON & output
  echo json_encode($search_arr);


} else {
  // No Categories
  echo json_encode(
    array('message' => 'No Search Found')
  );
}