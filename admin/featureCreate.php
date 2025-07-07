<!-- Meta File Start -->
<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {

	if (isset($_REQUEST['submit'])) {

		$sql = 'INSERT INTO `featured`(`title`, `content`, `button_title`, `button_url`, `image`, `is_active`, `is_featured`)  VALUES (?,?,?,?,?,?,?)';
		$stmt = $db->dbHandler->prepare($sql);
		$stmt->bindParam(1, $title);
		$stmt->bindParam(2, $content);
		$stmt->bindParam(3, $button_title);
		$stmt->bindParam(4, $button_url);
		$stmt->bindParam(5, $image);
		$stmt->bindParam(6, $is_active);
		$stmt->bindParam(7, $is_featured);

		$title = $_REQUEST['title'];
		$content = $_REQUEST['content'];
		$button_title = $_REQUEST['button_title'];
		$button_url = $_REQUEST['button_url'];
		// $btnOneUrl = $_REQUEST['btnOneUrl'];
		$is_active = $_REQUEST['is_active'];
		$is_featured = $_REQUEST['is_featured'];
		// $align = $_REQUEST['align'];
		// Upload File
		$dir = "../uploads/";
		$filename = $dir . $_FILES['image']['name'];
		if (move_uploaded_file($_FILES['image']['tmp_name'], $filename)) {
			$image = "uploads/" . $_FILES['image']['name'];
		} else {
			$image = "";
		}

		// $isActive = $_REQUEST['isActive'];
		// $password = md5($_REQUEST['password']);
		$stmt->execute();
		$msg = "Featured Insert Success!";
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
					<h2 class="font-weight-bold text-6">Create Featured</h2>

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
										<label class="" for="title">Title</label>
										<input type="text" name="title" class="form-control" id="title" placeholder="title">
									</div>
									<div class="form-group">
										<label class="" for="content">Content</label>
										<input type="text" name="content" class="form-control" id="content" placeholder="content">
									</div>
									<div class="form-group">
										<label class="" for="button_title">Button Text</label>
										<input type="text" name="button_title" class="form-control" id="button_title" placeholder="Shop Now">
									</div>
									<div class="form-group">
										<label class="" for="button_url">Button URL</label>
										<input type="text" name="button_url" class="form-control" id="button_url" placeholder="/Categories">
									</div>
				
									<div class="form-group">
										<label for="image">image</label>
										<input type="file" name="image" class="form-control" id="image">
									</div>
									<div class="form-group">
										<label for="is_active">Status</label>
										<select name="is_active" id="is_active" class="form-control">
											<option value="">~~Select~~</option>
											<option value="1">Active</option>
											<option value="0">Deactive</option>
										</select>
									</div>
                                    <div class="form-group">
										<label for="is_featured">Is Featured</label>
										<select name="is_featured" id="is_featured" class="form-control">
											<option value="">~~Select~~</option>
											<option value="1">Yes</option>
											<option value="0">No</option>
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