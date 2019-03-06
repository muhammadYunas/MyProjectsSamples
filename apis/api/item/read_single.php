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
$item = new Item($db);;

// Get ID
$item->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get item
$item->read_single();

// Create array
$item_arr = array(
  'id' => $item->id,
  'title' => $item->title,
  'description' => $item->description,
  'category_id' => $item->category_id,
  'author' => $item->author,
  'category_name' => $item->category_name,
  'created_at' => $item->created_at
);

// Make JSON
print_r(json_encode($item_arr));