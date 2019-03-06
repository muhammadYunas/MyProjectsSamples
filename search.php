<?php
  require_once('config/config.php');
  require_once('config/pdo.php');

  include('includes/header.php');
?>



<?php
if (isset($_GET['submit'])) {
	$search = $_GET['search'];
	$msg = '';

	$search = preg_replace("#[^0-9a-z]#i", "", $search);

	// $keyword = '%'.$search.'%';
	$query   = "SELECT * FROM items WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR author LIKE '%$search%'";
	$stmt = $c->query($query);
	$stmt->execute();
	$count = $stmt->rowCount();
	if ($search == '') {
		$msg .= '<div class="well text-danger">Search field is empty</div>';
		// header('Location: search.php?search=empty');
		exit();
	}else if ($count == 0) {
	$msg .= '<div class="well text-danger">No search result Found!</div>';
	} else {
		while ($row 	= $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			// $title 		= $row['title'];
			// $created_at = $row['created_at'];
			// $author 	= $row['author'];
			// $img 		= $row['img'];
			// $desc 		= $row['description'];
			$msg .= '<div class="well">
			<img style="width: 200px; height: 190px;" class="img-responsive img text-center" src="'.ITEM_IMG.$img.'">
			<h2>'.$title.'</h2>
			<small>Created at'.$created_at.' By '.$author.'</small>
			<p>'.$description.'</p>
			</div>';
		}
	}
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Search Result</h1>
			<h3>You searched for: " <?= isset($search) ? $search : null;  ?> "</h3>
			<br>
			<?php isset($msg) ? print("$msg") : null; ?>
		</div>
	</div>
</div>

<?php include('includes/footer.php'); ?>