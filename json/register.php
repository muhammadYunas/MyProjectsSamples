<?php
require_once('../config/config.php');
require_once('../config/pdo.php');

$user_name =    $_POST['name'];
$user_email =    $_POST['email'];
$user_password = $_POST['password'];

// $user_name =    'new user';
// $user_email =    'new@gmail.com';
// $user_password = 'new';

$query=" INSERT INTO user (username,email,userpassword) VALUES (?,?,?);";

$stmt = $c->prepare($query);
$stmt->execute([$user_name, $user_email, $user_password]);
$count = $stmt->rowCount();

if ($count > 0) {
	$msg = 'register success';
} else {
	$msg = 'register failed';
}

$response = [
	'success' => true,
	'response_code' => 200,
	'message' => $msg
];
echo json_encode($response);

?>