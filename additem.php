
<?php
require_once('config/config.php');
require_once('config/db.php');

	if(isset($_POST["submit"])) {

		 		$title 		   = mysqli_real_escape_string($c,$_POST['title']);
				$description   = mysqli_real_escape_string($c,$_POST['description']);
				$category_id   = mysqli_real_escape_string($c,$_POST['category_id']);
				$author 	   = mysqli_real_escape_string($c,$_POST['author']);
				$img  = $_FILES['img'];

        $fileName      = $_FILES["img"]["name"];
        $fileTmpName   = $_FILES["img"]["tmp_name"];
        $fileSize      = $_FILES["img"]["size"];
        $fileError     = $_FILES["img"]["error"];
        $fileType      = $_FILES["img"]["type"];

        $fileExt       = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        // echo print_r($img);

        $allowed       = array('jpg','jpeg','png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {

                	$fileNewName = uniqid().".".$fileName;
                    $fileDestination = 'uploads/items/'.$fileNewName;

                    $query = "INSERT INTO items (title,description,img,category_id,author) VALUES ('$title', '$description','$fileNewName','$category_id','$author')";

					if (mysqli_query($c, $query)) {
						header('Location: '.ROOT_URL.'successfully uploaded');
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
            echo 'ERROR: '. mysqli_error($c);
         }
}


?>

<?php include('includes/header.php'); ?>
<?php
if(!isset($_SESSION["id"])){

    echo '<div class="alert text-center alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>SORRY !</strong> You are not logged in !
          </div>';
    die();
} else {

    if($_SESSION["id"] || $_SESSION["name"]){

    }

}
?>

<div class="container mg-bottom-20">
	<div class="">
		<h1>Add Item</h1>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control">
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea cols="" rows="10" name="description" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<label>Image</label>
					<input required="" type="file" name="img" class="form-control" accept="*/image">
			</div>
			<div class="form-group">
				<label>Category</label>
				<select name="category_id" class="form-control">
					<option value="">--Select Category--</option>
					<option value="1">Books</option>
					<option value="2">Blood</option>
				</select>
			</div>
			<div class="form-group">
				<label>User</label>
				<select name="author" class="form-control">
					<option value="">--Select User--</option>
					<option value="1">younas</option>
				</select>
			</div>
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>
</div>
<?php include('includes/footer.php'); ?>