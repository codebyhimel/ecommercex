<!-- Meta File Start -->
<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
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
                    <h2 class="font-weight-bold text-6">Dashboard</h2>

                </header>

                <!-- start: page -->

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