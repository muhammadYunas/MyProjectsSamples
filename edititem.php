
<?php 
require_once('config/config.php');
require_once('config/db.php');
	// Check for submit

	// if (isset($_POST['submit'])) {
	// 	// get form data
	// 	$update_id   = mysqli_real_escape_string($c,$_POST['update_id']);
	// 	$title 		 = mysqli_real_escape_string($c,$_POST['title']);
	// 	$description = mysqli_real_escape_string($c,$_POST['description']);
	// 	$category 	 = mysqli_real_escape_string($c,$_POST['category']);
	// 	$uid 		 = mysqli_real_escape_string($c,$_POST['uid']);

		// $query  	 = "UPDATE items SET
		// 			  title = '$title',
		// 			  description = '$description',
		// 			  category = '$category',
		// 			  uid = '$uid'
		// 			  WHERE id = {$update_id}
		// 			 ";

		// if (mysqli_query($c, $query)) {
		// 	header('Location: '.ROOT_URL.'');
		// } else {
		// 	echo 'ERROR: '. mysqli_error($c);
		// }
	// }

if(isset($_POST['submit'])) {

		$update_id     = mysqli_real_escape_string($c,$_POST['update_id']);
 		$title 		   = mysqli_real_escape_string($c,$_POST['title']);
		$description   = mysqli_real_escape_string($c,$_POST['description']);
		$category_id   = mysqli_real_escape_string($c,$_POST['category_id']);
		$author 	   = mysqli_real_escape_string($c,$_POST['author']);
		// $img 		   = mysqli_real_escape_string($c, $_FILES['img']);

        $fileName      = $_FILES["img"]["name"];
        $fileTmpName   = $_FILES["img"]["tmp_name"];
        $fileSize      = $_FILES["img"]["size"];
        $fileError     = $_FILES["img"]["error"];
        $fileType      = $_FILES["img"]["type"];

        $fileExt       = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed       = array('jpg','jpeg','png');
        
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {

                	$fileNewName = uniqid().".".$fileName;
                    $fileDestination = 'uploads/items/'.$fileNewName;

                    $query  	  = "UPDATE items SET
					  title 	  = '$title',
					  description = '$description',
					  img 		  = '$fileNewName',
					  category_id = '$category_id',
					  author 	  = '$author'
					  WHERE id 	  = {$update_id}
					 ";

					if (mysqli_query($c, $query)) {
						header('Location: '.ROOT_URL.'');
					} else {
						echo 'ERROR: '. mysqli_error($c);
					}
                    
        			move_uploaded_file($fileTmpName, $fileDestination);
        			header('Location: '.ROOT_URL.'');

                    } else {
                       echo 'your file size is larger than 1MB';
                    }
             } else {
                 echo 'There was an error while uploading your file!';
             }
         } else {
            echo 'wrong file submitted';
         }
}

	// get ID
	$id = mysqli_real_escape_string($c, $_GET['id']);
	
	$query = 'SELECT * FROM items WHERE id = '. $id;

	$result = mysqli_query($c, $query);
	$item = mysqli_fetch_assoc($result);

	// echo "<pre>";
	// var_dump($items);
	// echo "</pre>";

	// Free Result 
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($c);
	

?>
<?php include('includes/header.php'); ?>
<div class="container mg-bottom-20">
	<div class="">
		<h1>Add Item</h1>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control" value="<?= $item['title']; ?>">
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea cols="" rows="10" name="description" class="form-control"><?= $item['description']; ?></textarea>
			</div>
			<div class="form-group">
				<label>Image</label>
				<img class="img-responsive" style="border: 1px dotted black; width: 50px; height: 50px;" src="<?= ITEM_IMG. $item['img']; ?>">
				<input type="file" name="img"  class="form-control" accept="*/image">
			</div>
			<div class="form-group">
				<label>Category</label>
				<select name="category_id" class="form-control">
					<option value="<?php echo $item['category_id']; ?>"><?= $item['category_id']; ?></option>
				</select>
			</div>
			<div class="form-group">
				<label>User</label>
				<select name="author" class="form-control">
					<option value="<?php echo $item['author']; ?>"><?= $item['author']; ?></option>
				</select>
			</div>
			<input type="hidden" name="update_id" value="<?= $item['id']; ?>">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>
</div>
<?php include('includes/footer.php'); ?>
