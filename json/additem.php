<?php
require_once('../config/config.php');
require_once('../config/pdo.php');

$title =    $_POST['title'];
$description = $_POST['description'];
$img = $_FILES['img'];
$imgname = $_FILES['img']['name'];
$imgtmppath = $_FILES['img']['tmp_path'];
$category = $_POST['category'];
$user = $_POST['uid'];

$query="INSERT INTO items (TITLE,DESCRIPTION,IMG,CATEGORY,UID) VALUES (?,?,?,?,?);";

$stmt = $c->prepare($query);
$stmt->execute([$title,$description,$imgname,$category,$user]);
$count = $stmt->rowCount();

if ($count > 0) {
	$msg = 'insert success';
} else {
	$msg = 'insert failed';
}

$response = [
	'success' => true,
	'response_code' => 200,
	'message' => $msg
];
echo json_encode($response);

?>