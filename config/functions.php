<?php
  // require('config/pdo.php');
  // require('config/db.php');

  // function category_name($category_id){
  //
  //   $query = "SELECT * FROM categories WHERE id =". $category_id;
  //   $result = mysqli_query($c, $query);
  //
  //   while ($item = mysqli_fetch_assoc($result)) {
  //     echo "<option value=".$item['category_id'].">".$item['category_id']."</option>";
  //   }
  // }

// function get_item_user($id){
// 	$sql  = "SELECT * FROM user WHERE id = ?";
// 	$stmt = $c->prepare($sql);
// 	$stmt->execute([$id]);
// 	$count = $stmt->rowCount();
// 	if ($count > 0) {
// 		$row = $stmt->fetch();
// 		return $row;
// 	} else {
// 		return 'Not Found';
// 	}
// }


// function get_item_user($id){
// 	$sql  = "SELECT * FROM user WHERE id = $id";
// 	$result = mysqli_query($c, $sql);
// 	$checkResult = mysqli_num_rows($result);
// 	if ($checkResult > 0) {
// 		$row = mysqli_fetch_assoc($result);
// 		return $row;
// 	} else {
// 		return false;
// 	}
// }

?>
