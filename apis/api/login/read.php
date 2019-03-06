<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Login.php';

// Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

// Instantiate login object
$login = new Login($db);

// login read query
$result = $login->read();

// Get row count
$num = $result->rowCount();

// Check if any login

if($num > 0){
  // Cat array
  $login_arr = array();
  $login_arr['data'] = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $login_item = array(
      'id' => $id,
      'email' => $email,
      'username' => $username
    );

    // Push to "data"
    array_push($login_arr['data'], $login_item);
  }

  // Turn to JSON & output
  echo json_encode($login_arr);


} else {
  // No Categories
  echo json_encode(
    array('message' => 'No login User Found')
  );
}