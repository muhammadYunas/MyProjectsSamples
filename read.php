<?php

require_once('config/config.php');
require_once('config/db.php');

	// check for submit
	if (isset($_POST['delete'])) {
		// get form data
		$delete_id = mysqli_real_escape_string($c,$_POST['delete_id']);

		$query = "DELETE FROM items WHERE id = {$delete_id}";

		if (mysqli_query($c, $query)) {
			header('Location: '.ROOT_URL.'');
		} else {
			echo 'ERROR: '. mysqli_error($c);
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
<section style="height: 60vh;">
	<div class="container">
		<div class="row">
			<a href="<?php echo ROOT_URL; ?>" class="btn btn-default"><span>&larr;</span> Back</a>
			<h1><?= $item['title']; ?></h1>
			<div>
				<img style="width: 100px; height: 90px;" class="img-responsive" src="<?= ITEM_IMG. $item['img']; ?>" />
			</div>
			<small>Created on <?= $item['created_at']; ?> by <?= $item['author']; ?></small>
			<p><?= $item['description']; ?></p>
			<hr>
			<form class="pull-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" name="delete_id" value="<?= $item['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn btn-danger">
			</form>
			<a href="<?php echo ROOT_URL; ?>edititem.php?id=<?= $item['id']; ?>" class="btn btn-default">Edit</a>
		</div>
	</div>
</section>
<?php include('includes/footer.php'); ?>