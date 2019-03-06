<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-with');

include_once '../../config/Database.php';
include_once '../../models/Item.php';

// Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

// Instantiate donationapp item object
$item = new Item($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$item->id = $data->id;

$item->title        = $data->title;
$item->description  = $data->description;
$item->img          = $data->img;
$item->category_id  = $data->category_id;
$item->author       = $data->author;

// Update item
if ($item->update()) {
  echo json_encode(
    array('message' => 'Item Updated')
  );
} else {
  echo json_encode(
    array('message' => "Item Not Updated")
  );
}