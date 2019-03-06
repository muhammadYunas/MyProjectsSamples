<?php
require_once('../config/config.php');
require_once('../config/pdo.php');

$user_email =    $_POST['email'];
$user_password = $_POST['password'];

$query=" SELECT * FROM user WHERE email = ? and userpassword = ?; ";

$stmt = $c->prepare($query);
$stmt->execute([$user_email, $user_password]);
$count = $stmt->rowCount();

if ($count > 0) {
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$msg = 'login success';
} else {
	$msg = 'login failed';
}

$response = [
	'success' => true,
	'response_code' => 200,
	'message' => $msg
];
echo json_encode($response);

?>