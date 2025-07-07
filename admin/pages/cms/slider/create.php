<!-- Meta File Start -->
<?php
include_once('../../../partials/meta.php');
include_once('../../../config/db.php');
session_start();
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
?>

	<!-- Meta File End -->
	<section class="body">

		<!-- start: header -->
		<?php
		include_once('../../../partials/header.php');
		?>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<?php
			include_once('../../../partials/sidebar.php');
			?>
			<!-- end: sidebar -->

			<section role="main" class="content-body content-body-modern">
				<header class="page-header page-header-left-inline-breadcrumb">
					<h2 class="font-weight-bold text-6">Dashboard</h2>

				</header>

				<!-- start: page -->
				<div class="row">
					<div class="col">
						<section class="card">
							<header class="card-header">
								<div class="card-actions">
									<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
									<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
								</div>

								<h2 class="card-title">Form Elements</h2>
							</header>
							<div class="card-body">
								<form class="form-horizontal form-bordered" method="get">
									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Default</label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="inputDefault">
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputDisabled">Disabled</label>
										<div class="col-lg-6">
											<input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputReadOnly">Read-Only Input</label>
										<div class="col-lg-6">
											<input type="text" value="Read-Only Input" id="inputReadOnly" class="form-control" readonly="readonly">
										</div>
									</div>

									<div class="form-group row pb-3">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputHelpText">Help text</label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="inputHelpText">
											<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputRounded">Rounded Input</label>
										<div class="col-lg-6">
											<input type="text" class="form-control input-rounded" id="inputRounded">
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputFocus">Input focus</label>
										<div class="col-lg-6">
											<input class="form-control" id="inputFocus" type="text" value="This is focused...">
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputPlaceholder">Placeholder</label>
										<div class="col-lg-6">
											<input type="text" class="form-control" placeholder="placeholder" id="inputPlaceholder">
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputPassword">Password</label>
										<div class="col-lg-6">
											<input type="password" class="form-control" placeholder="" id="inputPassword">
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-1">Static control</label>
										<div class="col-lg-6">
											<p class="form-control-static mb-0">email@example.com</p>
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2">Left Icon</label>
										<div class="col-lg-6">
											<div class="input-group">
												<span class="input-group-text">
													<i class="fas fa-user"></i>
												</span>
												<input type="text" class="form-control" placeholder="Left icon">
											</div>
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2">Right Icon</label>
										<div class="col-lg-6">
											<div class="input-group">
												<input type="text" class="form-control" placeholder="Right icon">
												<span class="input-group-text">
													<i class="fas fa-user"></i>
												</span>
											</div>
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2">File Upload</label>
										<div class="col-lg-6">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="input-append">
													<div class="uneditable-input">
														<i class="fas fa-file fileupload-exists"></i>
														<span class="fileupload-preview"></span>
													</div>
													<span class="btn btn-default btn-file">
														<span class="fileupload-exists">Change</span>
														<span class="fileupload-new">Select file</span>
														<input type="file" />
													</span>
													<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2">Vertical Group</label>
										<div class="col-lg-6">
											<section class="form-group-vertical">
												<input class="form-control" type="text" placeholder="Username">
												<input class="form-control" type="text" placeholder="Email">
												<input class="form-control last" type="password" placeholder="Password">
											</section>
										</div>
									</div>

									<div class="form-group row pb-4 has-success">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputSuccess">Input with success</label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="inputSuccess">
										</div>
									</div>
									<div class="form-group row pb-4 has-warning">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputWarning">Input with warning</label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="inputWarning">
										</div>
									</div>
									<div class="form-group row pb-4 has-danger">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputError">Input with error</label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="inputError">
										</div>
									</div>

									<div class="form-group row pb-4 mb-2">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputTooltip">Input with Tooltip</label>
										<div class="col-lg-6">
											<input type="text" placeholder="Hover me" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" class="form-control" data-original-title="Place your tooltip info here" id="inputTooltip">
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2" for="inputPopover">Input with Popover</label>
										<div class="col-lg-6">
											<input type="text" placeholder="Click Here" class="form-control" data-bs-toggle="popover" data-bs-placement="top" data-original-title="The Title" data-bs-content="Content goes here..." data-bs-trigger="click" id="inputPopover">
										</div>
									</div>

									<div class="form-group row pb-4">
										<label class="col-lg-3 control-label text-lg-end pt-2">Column sizing</label>
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-2">
													<input type="text" class="form-control" placeholder=".col-sm-2">
												</div>
												<div class="d-md-none mb-3"></div>
												<div class="col-sm-3">
													<input type="text" class="form-control" placeholder=".col-sm-3">
												</div>
												<div class="d-md-none mb-3"></div>
												<div class="col-sm-4">
													<input type="text" class="form-control" placeholder=".col-sm-4">
												</div>
											</div>

										</div>
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
	include_once('../../../partials/footer.php');
	?>

<?php
} else {
	header('location: http://localhost/ecoomercex/admin/login.php');
}
?>