<?php
require_once('../config/config.php');
require_once('../config/pdo.php');

$query = "SELECT * FROM items";
$stmt = $c->prepare($query);
$stmt->execute();

$count = $stmt->rowCount();

if ($count > 0) {
	$items = $stmt->fetch(PDO::FETCH_ASSOC);
	while ($row[] = $stmt->fetch()) {
	echo "login successfully";
	$data = json_encode($row);
	// echo "<pre>";
	echo $data;
	// echo "</pre>";
	}
} else {
 echo "0 results";
}

// echo $data;