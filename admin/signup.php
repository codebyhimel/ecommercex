<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
$msg = "";
$pasMag = "";
$db = new Db();
if (isset($_POST['submit'])) {
	if ($_REQUEST['password'] != $_REQUEST['pwd_confirm']) {
		$pasMag = "Confirm Password Not Match";
		// echo "<script>alert('$pasMag')</script>";
	} else {
		$sql = 'INSERT INTO `db_user`(`username`, `phone`, `email`, `password`) 
		VALUES (:username, :phone, :email, :password)';
		$stmt = $db->dbHandler->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':phone', $phone);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$username = $_REQUEST['username'];
		$phone = $_REQUEST['phone'];
		$email = $_REQUEST['email'];
		$password = md5($_REQUEST['password']);
		$stmt->execute();
		$msg = "Registration Successfull please Login";
	}
}
?>
<!-- start: page -->
<section class="body-sign">
	<div class="center-sign">
		<a href="/" class="logo float-start">
			<img src="assets/img/logo.png" height="70" alt="Porto Admin" />
		</a>

		<div class="panel card-sign">
			<div class="card-title-sign mt-3 text-end">
				<h2 class="title text-uppercase font-weight-bold m-0"><i class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Sign Up</h2>
				<p><b class="text-success">
						<?php
						if ($msg != "") {
							echo $msg;
							// sleep((5000 / 1000));
							// header('location: http://localhost/ecoomercex/admin/login.php');
						}
						?>
					</b></p>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="form-group mb-3">
						<label>Name</label>
						<input name="username" type="text" class="form-control form-control-lg" />
					</div>
					<div class="form-group mb-3">
						<label>Phone Number</label>
						<input name="phone" type="tel" class="form-control form-control-lg" />
					</div>
					<div class="form-group mb-3">
						<label>E-mail Address</label>
						<input name="email" type="email" class="form-control form-control-lg" />
					</div>

					<div class="form-group mb-0">
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label>Password</label>
								<input name="password" type="password" class="form-control form-control-lg" />
								<p><b class="text-danger">
										<?php
										if ($pasMag != "") {
											echo $pasMag;
										}
										?>
									</b></p>
							</div>
							<div class="col-sm-6 mb-3">
								<label>Password Confirmation</label>
								<input name="pwd_confirm" type="password" class="form-control form-control-lg" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-8">
							<div class="checkbox-custom checkbox-default">
								<input id="AgreeTerms" name="agreeterms" type="checkbox" />
								<label for="AgreeTerms">I agree with <a href="#">terms of use</a></label>
							</div>
						</div>
						<div class="col-sm-4 text-end">
							<button type="submit" class="btn btn-primary mt-2" name="submit" value="submit">Sign Up</button>
						</div>
					</div>

					<span class="mt-3 mb-3 line-thru text-center text-uppercase">
						<span>or</span>
					</span>

					<div class="mb-1 text-center">
						<a class="btn btn-facebook mb-3 ms-1 me-1" href="#">Connect with <i class="fab fa-facebook-f"></i></a>
					</div>

					<p class="text-center">Already have an account? <a href="login.php">Sign In!</a></p>

				</form>
			</div>
		</div>

		<p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2023. All Rights Reserved.</p>
	</div>
</section>
<!-- end: page -->
<?php
include_once('./partials/footer.php');
?>