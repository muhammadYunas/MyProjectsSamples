<?php
require_once('config/config.php');
require_once('config/db.php');
include("includes/header.php");
session_start();
?>

<section class="section-default" style="height: 60vh;">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">

				<?php
					if (isset($_POST['reset-password'])) {
						$selector  	 = $_POST["selector"];
						$validator 	 = $_POST["validator"];
						$newpwd = $_POST["pwd"];
						$confirmpwd  = $_POST["confirm-pwd"];

						if (empty($newpwd) || empty($confirmpwd)) {
							header("Location: create-new-password.php?newpwd=empty");
							exit();
						} elseif ($newpwd != $confirmpwd) {
							header("Location: create-new-password.php?newpwd=new-password-and-cofirm-password-not-same");
							exit();
						}

						$currentDate = date("U");

						$sql = "SELECT * FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
						$stmt 	  = mysqli_stmt_init($c);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo "There was an error";
							exit();
						} else {
							mysqli_stmt_bind_param($stmt, 'ss', $selector,$currentDate);
							mysqli_stmt_execute($stmt);

							$result  = mysqli_stmt_get_result($stmt);
							if (!$row = mysqli_fetch_assoc($result)) {
								echo 'You need to re-submit your reset request.';
								exit();
							} else {

								$tokenBin   = hex2bin($validator);
								$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

								if ($tokenCheck === false) {
									echo 'You need to re-submit your reset request.';
									exit();
								} elseif ($tokenCheck === true) {

									$tokenEmail = $row['pwdResetEmail'];

									$sql = "SELECT * FROM user WHERE email = ?";
									$stmt 	  = mysqli_stmt_init($c);
									if (!mysqli_stmt_prepare($stmt, $sql)) {
										echo "There was an error";
										exit();
									} else {
										mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
										mysqli_stmt_execute($stmt);
										$result  = mysqli_stmt_get_result($stmt);
										if (!$row = mysqli_fetch_assoc($result)) {
											echo 'There was an error!';
											exit();
										} else {

											$sql = "UPDATE user SET password = ? WHERE email = ?";
											$stmt 	  = mysqli_stmt_init($c);
											if (!mysqli_stmt_prepare($stmt, $sql)) {
												echo "There was an error";
												exit();
											} else {

												$newPwdHash = password_hash($newpwd, PASSWORD_DEFAULT);
												mysqli_stmt_bind_param($stmt, "s", $newPwdHash,$tokenEmail);
												mysqli_stmt_execute($stmt);

												$sql 	  = "DELETE FROM pwdreset WHERE pwdResetEmail = ?;";
												$stmt 	  = mysqli_stmt_init($c);
												if (!mysqli_stmt_prepare($stmt, $sql)) {
													echo "There was an error";
													exit();
												} else {
													mysqli_stmt_bind_param($stmt, 's', $tokenEmail);
													mysqli_stmt_execute($stmt);
													header("Location: login.php?newpwd=passwordUpdated");
												}

											}

										}
									}
								}
							}
						}


					}
				?>
				<?php
					$selector  = $_GET["selector"];
					$validator = $_GET["validator"];

					if (empty($selector) || empty($validator)) {
						echo "Could not validate your request!";
					} else {
						if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
					?>

					<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="text-center">
						<h1>Reset Password Form</h1>
					</div>
						<input class="form-control" type="hidden" name="selector" value="<?php echo $selector; ?>">
						<input class="form-control" type="hidden" name="validator" value="<?php echo $validator; ?>">
					<div class="form-group">
						<input class="form-control" type="password" name="pwd" placeholder="Enter New Password">
					</div>
					<div class="form-group">
						<input class="form-control" type="password" name="confirm-pwd" placeholder="Confirm New Password">
					</div>
						<input class="form-control btn btn-default" value="Reset Password" type="submit" name="reset-password">
					</form>

					<?php
						}
					}
				?>
			</div>	
		</div>
	</div>
</section>

<?php
include("includes/header.php");
?>