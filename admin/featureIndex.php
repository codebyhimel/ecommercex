<!-- Meta File Start -->
<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {

    $sql = "SELECT * FROM `featured`";
    $stmt = $db->dbHandler->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($data);

    if (isset($_REQUEST['delete_id'])) {
        $qry = "DELETE FROM `featured` where id = :id";
        $dtmt = $db->dbHandler->prepare($qry);
        $dtmt->bindParam(':id', $_REQUEST['delete_id']);
        if ($dtmt->execute()) {
            $msg = "Record Delete Success!";
            header("location: SliderIndex.php");
        } else {
            $msg = "Record Delete Fail!";
        }
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
                    <h2 class="font-weight-bold text-6">Featured</h2>
                    <div class="right-wrapper">
                        <ol class="breadcrumbs">

                            <li><span>Home</span></li>

                            <li><span>Featured List</span></li>

                            <!-- <li><span>Coupons</span></li> -->

                        </ol>

                        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
                    </div>
                </header>
                <?php
                if ($msg != null) {
                    echo $msg;
                }
                ?>
                <!-- start: page -->
                <div class="row">
                    <div class="col">

                        <div class="card card-modern">
                            <div class="card-body">
                                <div class="datatables-header-footer-wrapper">
                                    <div class="datatable-header">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                                                <a href="/ecoomercex/admin/featureCreate.php" class="btn btn-primary btn-md font-weight-semibold btn-py-2 px-4">+ Add Featured</a>
                                            </div>
                                            <div class="col-8 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">
                                                <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                                    <label class="ws-nowrap me-3 mb-0">Filter By:</label>
                                                    <select class="form-control select-style-1 filter-by" name="filter-by">
                                                        <option value="all" selected>All</option>
                                                        <option value="1">ID</option>
                                                        <option value="2">Image</option>
                                                        <option value="3">Title</option>
                                                        <option value="4">Status</option>
                                                        <option value="5">Create At</option>
                                                        <option value="6">Action</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">
                                                <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                                    <label class="ws-nowrap me-3 mb-0">Show:</label>
                                                    <select class="form-control select-style-1 results-per-page" name="results-per-page">
                                                        <option value="12" selected>12</option>
                                                        <option value="24">24</option>
                                                        <option value="36">36</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-auto ps-lg-1">
                                                <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                                    <div class="input-group">
                                                        <input type="text" class="search-term form-control" name="search-term" id="search-term" placeholder="Search Order">
                                                        <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 750px;">

                                        <thead>
                                            <tr>
                                                <th width="3%"><input type="checkbox" name="select-all" class="select-all checkbox-style-1 p-relative top-2" value="" /></th>
                                                <th width="8%">ID</th>
                                                <th width="10%">Image</th>
                                                <th width="20%">Title</th>
                                                <th width="10%">Status</th>
                                                <th width="10%">Is Featured</th>
                                                <th width="12%">Create At</th>
                                                <th width="12%">Update At</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($data as $item) {

                                            ?>
                                                <tr>
                                                    <td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
                                                    <td><?= $item['id'] ?></td>
                                                    <td><img src="../<?= $item['image'] ?>" alt="!" height="50"></td>
                                                    <td><?= $item['title'] ?></td>
                                                    <td><?php
                                                        if ($item['is_active'] == 1) {
                                                            echo "<button class='btn btn-primary'>Active</button>";
                                                        } else {
                                                            echo "<button class='btn btn-danger'>Deactive</button>";
                                                        }
                                                        ?></td>
                                                    <td><?php
                                                        if ($item['is_featured'] == 1) {
                                                            echo "<button class='btn btn-primary'>Yes</button>";
                                                        } else {
                                                            echo "<button class='btn btn-danger'>No</button>";
                                                        }
                                                        ?></td>
                                                    <td>
                                                        <?php
                                                        $createAt = strtotime($item['created_at']);
                                                        echo date("d-M-Y", $createAt);
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $updated_at = strtotime($item['updated_at']);
                                                        echo date("d-M-Y", $updated_at);
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="./featureEdit.php?edit_id=<?= $item['id']; ?>" class="btn btn-primary">Edit</a>
                                                        <a href="./featureIndex.php?delete_id=<?= $item['id']; ?>" class="btn btn-danger" onclick="return checkDelete()">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <hr class="solid mt-5 opacity-4">
                                    <div class="datatable-footer">
                                        <div class="row align-items-center justify-content-between mt-3">

                                            <div class="col-lg-auto text-center order-3 order-lg-2">
                                                <div class="results-info-wrapper"></div>
                                            </div>
                                            <div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
                                                <div class="pagination-wrapper"></div>
                                            </div>
                                        </div>
                                    </div>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end: page -->
            </section>
        </div>


    </section>

    <?php
    include_once('./partials/footer.php');

    ?>
    <script language="JavaScript" type="text/javascript">
        function checkDelete() {
            return confirm('Are you sure?');
        }
    </script>

<?php
} else {
    header('location: http://localhost/ecoomercex/admin/login.php');
}
?>