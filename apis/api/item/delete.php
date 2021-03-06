<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// Set ID to Delete
$item->id = $data->id;

// Delete item
if ($item->delete()) {
  echo json_encode(
    array('message' => 'Item Deleted')
  );
} else {
  echo json_encode(
    array('message' => "Item Not Deleted")
  );
}