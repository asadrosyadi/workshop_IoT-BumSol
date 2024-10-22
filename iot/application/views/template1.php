<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php header('Access-Control-Allow-Origin: *'); ?>

    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<body>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <div class="page-wrapper">

            <?php
            echo $contents;
            ?>


        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme center">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-6 mb-md-0 text-center">
                    © SHIELD
                    <script>
                        document.write(new Date().getFullYear());
                    </script>, Dibuat Oleh Sistem Pendeteksi Dini Stunting ❤️
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!--<script src="<?php echo base_url() ?>assets/assets/libs/jquery/dist/jquery.min.js"></script>-->
    <script src="<?php echo base_url() ?>assets/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="<?php echo base_url() ?>assets/dist/js/app-style-switcher.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/feather.min.js"></script>
    <script src="<?php echo base_url() ?>assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>assets/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="<?php echo base_url() ?>assets/assets/extra-libs/c3/d3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/assets/extra-libs/c3/c3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="<?php echo base_url() ?>assets/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="<?php echo base_url() ?>assets/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo base_url() ?>assets/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/pages/dashboards/dashboard1.min.js"></script>

    <script src="<?php echo base_url() ?>assets/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script src="<?php echo base_url() ?>assets/assets/extra-libs/knob/jquery.knob.min.js"> </script>


    <!-- Core JS -->
    <script src="<?php echo base_url('assets/assets/ghulam/') ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo base_url('assets/assets/ghulam/') ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo base_url('assets/assets/ghulam/') ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url('assets/assets/ghulam/') ?>assets/vendor/js/menu.js"></script>
    <script src="<?php echo base_url('assets/assets/ghulam/') ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="<?php echo base_url('assets/assets/ghulam/') ?>assets/js/main.js"></script>
    <script src="<?php echo base_url('assets/assets/ghulam/') ?>assets/js/dashboards-analytics.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });



        $('.form-check-input').on('click', function() {
            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');

            $.ajax({
                url: "<?= base_url('admin/changeaccess'); ?>",
                type: 'post',
                data: {
                    menuId: menuId,
                    roleId: roleId
                },
                success: function() {
                    document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                }
            });

        });
    </script>
</body>

</html>