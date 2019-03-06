<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Register.php';

// Instantiate DB & connect
$database = new Database();
$db       = $database->connect();

// Instantiate Login object
$register = new Register($db);

// Get raw itemed data
$data = json_decode(file_get_contents("php://input"));

$register->username        = $data->username;
$register->email  = $data->email;
$register->userpassword          = $data->userpassword;

// Create res$register
if ($register->register()) {
  echo json_encode(
    array('message' => 'User Registered')
  );
} else {
  echo json_encode(
    array('message' => "User didn't Registered")
  );
}