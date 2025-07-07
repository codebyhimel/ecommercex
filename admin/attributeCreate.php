<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
    if (isset($_POST['submit'])) {
        $sql = "INSERT INTO `attribute`(`name`, `type`, `isActive`, `create_at`) VALUES (?, ?, ?, ?)";
        $stmt = $db->dbHandler->prepare($sql);

        $name = $_POST['name'];
        $type = $_POST['type'];
        $isActive = $_POST['isActive'];
        $createAt = date('Y-m-d H:i:s');

        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $type);
        $stmt->bindParam(3, $isActive);
        $stmt->bindParam(4, $createAt);
        $stmt->execute();
        $msg = "Attribute Inserted Successfully!";
    }
?>
    <!-- Meta File End -->
    <section class="body">

        <!-- start: header -->
        <?php include_once('./partials/header.php'); ?>
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <?php include_once('./partials/sidebar.php'); ?>
            <!-- end: sidebar -->

            <section role="main" class="content-body content-body-modern">
                <header class="page-header page-header-left-inline-breadcrumb">
                    <h2 class="font-weight-bold text-6">Create Attribute</h2>
                </header>

                <!-- start: page -->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <section class="card">
                            <div class="card-body p-4">
                                <?php if ($msg != null): ?>
                                    <div class="alert alert-success">
                                        <?= $msg ?>
                                    </div>
                                <?php endif; ?>

                                <form action="" method="post">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Attribute Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter attribute name" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <input type="text" name="type" id="type" class="form-control" placeholder="Enter type" required>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="isActive" class="form-label">Status</label>
                                        <select name="isActive" id="isActive" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Save Attribute</button>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- end: page -->
            </section>
        </div>
    </section>

    <?php include_once('./partials/footer.php'); ?>

<?php
} else {
    header('Location: http://localhost/ecoomercex/admin/login.php');
    exit;
}
?>