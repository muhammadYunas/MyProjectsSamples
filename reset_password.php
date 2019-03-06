<?php
require_once('config/config.php');
require_once('config/db.php');
include("includes/header.php");
?>

<?php

if (isset($_POST['submit'])) {
	session_start();
	$selector = bin2hex(random_bytes(8));
	$token 	  = random_bytes(32);

	$url	  = ROOT_URL ."/create-new-password.php?selector=$selector&validator=".bin2hex($token);

	$expires  = date("U") + 1800;

	$email 	  = $_POST['email'];

	if (empty($email)) {
		header("Location: reset_password.php?reset=empty");
		exit();
	}

	$sql 	  = "DELETE FROM pwdreset WHERE pwdResetEmail = ?;";
	$stmt 	  = mysqli_stmt_init($c);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, 's', $email);
		mysqli_stmt_execute($stmt);
	}


	$sql 	 = "INSERT INTO pwdreset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";
	$stmt 	 = mysqli_stmt_init($c);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error";
		exit();
	} else {
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, 'ssss', $email, $selector, $hashedToken, $expires);
		mysqli_stmt_execute($stmt);
	}

	mysqli_stmt_close($stmt);
	mysqli_close($c);

	$to 	  = $email;
	$subject  = 'Reset your password for donation website';
	$message  = '<p>We received a password reset request. the link to reset your password is below if you did not make this request, you can ignore this email</p>';
	$message .= '<p>Here is your password reset link: </br>';
	$message .= '<a href="' . $url .'">' . $url .'</a></p>';

	$headers  = "From: M YOUNAS <younas.ibms@gmail.com>\r\n";
	$headers .= "Reply To: younas.ibms@gmail.com\r\n";
	$headers .= "Content-type: text/html\r\n";

	$email = mail($to, $subject, $message, $headers);

	header('Location: reset_password.php?reset=success');

}

?>

<?php
	if (isset($_GET['reset'])) {
		if ($_GET["reset"] == "success") {
			echo "<div  class='alert alert-primary text-center msg-success col-md-6 col-md-offset-3' role='alert'>Please Check Your Email!</div>";
		}
	}
?>

<section class="section-default" style="height: 60vh;">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<h1>Reset Your Password</h1>
				<p>An Email will be send to you with instructions on how to reset your password.</p>
				<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="Enter Your Email Address..">
					</div>
					<input type="submit" name="submit" value="Click to Receive Reset Password Link By Email" class="btn btn-default">
				</form>
			</div>
		</div>
	</div>
</section>

<?php
include("includes/footer.php");
?>
