<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-with');

include_once '../../config/Database.php';
include_once '../../models/Item.php';

// Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

// Instantiate blog item object
$item = new Item($db);

// Get raw itemed data
$data = json_decode(file_get_contents("php://input"));

if(is_array($data)){

  foreach($data as $key => $value){
    $_POST[$key] = $value;
  }
}

$item->title = $_POST['title'];
$item->description = $_POST['description'];

$img = $_FILES['img']['name'];
$imgtmp = $_FILES['img']['tmp_name'];
// $imgnewname = uniqid() . $img;

$item->img = uniqid() .".". $_FILES['img']['name'];

$item->category_id = $_POST['category_id'];
$item->author = $_POST['author'];
// C:\xampp\htdocs\donationapp\uploads\api_img;
$uploadto = "../../../uploads/items/" . $item->img;
move_uploaded_file($imgtmp, $uploadto);
// Create item
if ($item->create()) {

  echo json_encode(
    array('message' => 'Item Created')
  );
} else {
  echo json_encode(
    array('message' => "Item Not Created")
  );
}
