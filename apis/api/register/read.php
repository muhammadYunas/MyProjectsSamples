<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Register.php';

// Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

// Instantiate register object
$register = new Register($db);

// register read query
$result = $register->read();

// Get row count
$num = $result->rowCount();

// Check if any registers

if($num > 0){
  // Cat array
  $reg_arr = array();
  $reg_arr['data'] = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $reg_item = array(
      'id' => $id,
      'email' => $email,
      'username' => $username
    );

    // Push to "data"
    array_push($reg_arr['data'], $reg_item);
  }

  // Turn to JSON & output
  echo json_encode($reg_arr);


} else {
  // No Categories
  echo json_encode(
    array('message' => 'No Registered User Found')
  );
}