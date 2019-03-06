<?php
  require_once('config/config.php');
  require_once('config/db.php');
  require_once('config/pdo.php');
?>

<?php include('includes/header.php'); ?>
<?php include('includes/carousel.php'); ?>

<?php
// if (isset($_SESSION['name'])) {  
// 	echo "welcome {$_SESSION['name']} to our websit!";
// }
?>

<div class="container">
	<div class="row">

		<div class="col-md-3">
			<h1 class="text-uppercase bg-color text-center">Categories</h1>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Search Books
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <ul class="nav navbar-inline">
							    <li><a href="#">university books</a></li>
							    <li><a href="#">islamic books</a></li>
							    <li><a href="#">novel</a></li>
							    <li><a href="#">poetry</a></li>
							    <li><a href="#">phd books</a></li>
						    </ul>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Search for dress
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <ul class="nav navbar-inline">
							    <li><a href="#">clothes</a></li>
							    <li><a href="#">jacket</a></li>
							    <li><a href="#">baby dress</a></li>
							    <li><a href="#">college uniform</a></li>
							    <li><a href="#">sweeter</a></li>
						    </ul>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Search for more items
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <ul class="nav navbar-inline">
							    <li><a href="#">clothes</a></li>
							    <li><a href="#">jacket</a></li>
							    <li><a href="#">baby dress</a></li>
							    <li><a href="#">college uniform</a></li>
							    <li><a href="#">sweeter</a></li>
						    </ul>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-md-9">
			<?php
			$query = "SELECT * FROM items ORDER BY created_at DESC";
				$stmt = $c->prepare($query);
				$stmt->execute();
				$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

			?>
			<h1 class="text-uppercase bg-color text-center">Latest Items</h1>
			<?php foreach($items as $item) : ?>
				<div class="col-md-4 col-sm-6">
				<div class="well">
					<h3><?= $item['title']; ?></h3>
					<div>
						<img style="width: 200px; height: 190px;" class="img-responsive img text-center" src="<?= ITEM_IMG. $item['img']; ?>">
					</div>
					<small>Created on <?= $item['created_at']; ?> by <?= $item['author']; ?></small>
					<p><?= $item['description']; ?></p>
					<a class="btn btn-default" href="<?= ROOT_URL; ?>read.php?id=<?= $item['id']; ?>">Read more</a>
				</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
		// Free Result
			// mysqli_free_result($result);

			// // Close Connection
			// mysqli_close($c);
		?>
	</div>
</div>
<?php include('includes/footer.php'); ?>
