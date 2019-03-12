
<?php
require_once('config/config.php');
require_once('config/db.php');

	if(isset($_POST["submit"])) {

 		$title 		   	 = mysqli_real_escape_string($c,$_POST['title']);
		$description   = mysqli_real_escape_string($c,$_POST['description']);
		$category_id   = mysqli_real_escape_string($c,$_POST['category_id']);
		$author 	   	 = mysqli_real_escape_string($c,$_POST['author']);
		$img  				 = $_FILES['img'];

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
    header('Location: index.php?user=Not_Authorize');
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
				<textarea cols="" rows="10" name="description" class="form-control" id="desc"></textarea>
			</div>
			<div class="form-group">
				<label>Image</label>
					<input required="" type="file" name="img" class="form-control" accept="*/image">
			</div>
			<div class="form-group">
				<label>Category</label>
				<select name="category_id" class="form-control">
					<option value="">--Select Category--</option>
					<?php
					$query = "SELECT * FROM categories";
					$result = mysqli_query($c, $query);

					while ($items = mysqli_fetch_assoc($result)) {
						echo "<option value=".$items['id'].">".$items['name']."</option>";
					}
					mysqli_free_result($result);
					// Close Connection
					mysqli_close($c);
					?>
				</select>
			</div>
			<div class="form-group">
				<input type='hidden' name='author' value="<?= $_SESSION['id']; ?>">
			</div>
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>
</div>

<script src="./summernote/summernote.min.js"></script>
<script>
		$('#desc').summernote({
				height:300
		});
</script>
<?php include('includes/footer.php'); ?>
