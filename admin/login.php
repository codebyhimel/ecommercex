<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$testdata = [
	'Msg' => '',
	'id' => '',
	'email' => '',
	'username' => '',
	'login' => false,
];
$_SESSION['data'] = $testdata;
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
	header('location: http://localhost/ecoomercex/admin/dashboard.php');
}
$msg = "";
$pasMag = "";
$db = new Db();
if (isset($_POST['submit'])) {

	$sql = 'SELECT * FROM `db_user` WHERE  email = ? or username = ?';
	$stmt = $db->dbHandler->prepare($sql);
	$stmt->bindParam(1, $username);
	$stmt->bindParam(2, $username);
	// $stmt->bindParam(':email', $email);
	// $stmt->bindParam(':password', $password);
	$username = $_REQUEST['username'];
	// $email = $_REQUEST['email'];

	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	$password = md5($_REQUEST['password']);
	if (!empty($data['email'])) {
		// echo $data['email'];
		if ($password == $data['password']) {
			// session_start();
			$dataArr = [
				'Msg' => 'Login Success!',
				'id' => $data['id'],
				'email' => $data['email'],
				'username' => $data['username'],
				'login' => true,
			];
			$_SESSION['data'] = $dataArr;
			header('location:http://localhost/ecoomercex/admin/dashboard.php');
			$msg = "Login Success!";
		} else {
			$msg = "Invalid Email or Password";
		}
	} else {
		$msg = "Invalid username or Email";
	}
	// print_r($data);
	// $msg = "Registration Successfull please Login";

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
				<h2 class="title text-uppercase font-weight-bold m-0"><i class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Sign In</h2>
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
						<label>Username</label>
						<div class="input-group">
							<input name="username" type="text" class="form-control form-control-lg" />
							<span class="input-group-text">
								<i class="bx bx-user text-4"></i>
							</span>
						</div>
					</div>

					<div class="form-group mb-3">
						<div class="clearfix">
							<label class="float-start">Password</label>
							<a href="forgate-password.php" class="float-end">Lost Password?</a>
						</div>
						<div class="input-group">
							<input name="password" type="password" class="form-control form-control-lg" />
							<span class="input-group-text">
								<i class="bx bx-lock text-4"></i>
							</span>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-8">
							<div class="checkbox-custom checkbox-default">
								<input id="RememberMe" name="rememberme" type="checkbox" />
								<label for="RememberMe">Remember Me</label>
							</div>
						</div>
						<div class="col-sm-4 text-end">
							<button type="submit" class="btn btn-primary mt-2" name="submit" value="submit">Sign In</button>
						</div>
					</div>

					<span class="mt-3 mb-3 line-thru text-center text-uppercase">
						<span>or</span>
					</span>

					<div class="mb-1 text-center">
						<a class="btn btn-facebook mb-3 ms-1 me-1" href="#">Connect with <i class="fab fa-facebook-f"></i></a>
					</div>

					<p class="text-center">Don't have an account yet? <a href="signup.php">Sign Up!</a></p>

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