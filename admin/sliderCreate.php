<!-- Meta File Start -->
<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {

	if (isset($_REQUEST['submit'])) {

		$sql = 'INSERT INTO `slidertable`(`subTitle`, `title`, `details`, `btnOneText`, `btnOneUrl`, `btnTwoTxt`, `btnTwoUrl`, `align`, `image`, `isActive`) VALUES (?,?,?,?,?,?,?,?,?,?)';
		$stmt = $db->dbHandler->prepare($sql);
		$stmt->bindParam(1, $subTitle);
		$stmt->bindParam(2, $title);
		$stmt->bindParam(3, $details);
		$stmt->bindParam(4, $btnOneText);
		$stmt->bindParam(5, $btnOneUrl);
		$stmt->bindParam(6, $btnTwoTxt);
		$stmt->bindParam(7, $btnTwoUrl);
		$stmt->bindParam(8, $align);
		$stmt->bindParam(9, $image);
		$stmt->bindParam(10, $isActive);
		$subTitle = $_REQUEST['subTitle'];
		$title = $_REQUEST['title'];
		$details = $_REQUEST['details'];
		$btnOneText = $_REQUEST['btnOneText'];
		$btnOneUrl = $_REQUEST['btnOneUrl'];
		$btnTwoTxt = $_REQUEST['btnTwoTxt'];
		$btnTwoUrl = $_REQUEST['btnTwoUrl'];
		$align = $_REQUEST['align'];
		// Upload File
		$dir = "../uploads/";
		$filename = $dir . $_FILES['image']['name'];
		if (move_uploaded_file($_FILES['image']['tmp_name'], $filename)) {
			$image = "uploads/" . $_FILES['image']['name'];
		} else {
			$image = "";
		}

		$isActive = $_REQUEST['isActive'];
		// $password = md5($_REQUEST['password']);
		$stmt->execute();
		$msg = "Silder Insert Success!";
	}
?>

	<!-- Meta File End -->
	<section class="body">

		<!-- start: header -->
		<?php
		include_once('./partials/header.php');
		?>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<?php
			include_once('./partials/sidebar.php');
			?>
			<!-- end: sidebar -->

			<section role="main" class="content-body content-body-modern">
				<header class="page-header page-header-left-inline-breadcrumb">
					<h2 class="font-weight-bold text-6">Create Slider</h2>

				</header>

				<!-- start: page -->
				<div class="row">
					<div class="col-12">
						<section class="card">
							<div class="card-body p-5">
								<?php
								if ($msg != null) {
									echo $msg;
								}
								?>
								<form action="" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label class="" for="subTitle">sub Title</label>
										<input type="text" name="subTitle" class="form-control" id="subTitle" placeholder="subTitle">
									</div>
									<div class="form-group">
										<label class="" for="title">Title</label>
										<input type="text" name="title" class="form-control" id="title" placeholder="title">
									</div>
									<div class="form-group">
										<label class="" for="details">Details</label>
										<input type="text" name="details" class="form-control" id="details" placeholder="details">
									</div>
									<div class="form-group">
										<label class="" for="btnOneText">Button One Text</label>
										<input type="text" name="btnOneText" class="form-control" id="btnOneText" placeholder="Shop Now">
									</div>
									<div class="form-group">
										<label class="" for="btnOneUrl">Button One URL</label>
										<input type="text" name="btnOneUrl" class="form-control" id="btnOneUrl" placeholder="/Categories">
									</div>
									<div class="form-group">
										<label class="" for="btnTwoTxt">Button Two Txt</label>
										<input type="text" name="btnTwoTxt" class="form-control" id="btnTwoTxt" placeholder="Explore">
									</div>
									<div class="form-group">
										<label class="" for="btnTwoUrl">Button Two URL</label>
										<input type="text" name="btnTwoUrl" class="form-control" id="btnTwoUrl" placeholder="/contact">
									</div>
									<div class="form-group">
										<label class="" for="align">Slider Text Aligntmnt </label>
										<input type="text" name="align" class="form-control" id="align" placeholder="center">
									</div>

									<div class="form-group">
										<label for="image">image</label>
										<input type="file" name="image" class="form-control" id="image">
									</div>
									<div class="form-group">
										<label for="isActive">Status</label>
										<select name="isActive" id="isActive" class="form-control">
											<option value="">~~Select~~</option>
											<option value="1">Active</option>
											<option value="0">Deactive</option>
										</select>
									</div>
									<div class="form-group">
										<button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
									</div>
								</form>
							</div>
						</section>
					</div>
				</div>
				<!-- end: page -->
			</section>
		</div>


	</section>

	<?php
	include_once('./partials/footer.php');
	?>

<?php
} else {
	header('location: http://localhost/ecoomercex/admin/login.php');
}
?>