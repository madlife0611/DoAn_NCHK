<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product_Detail_<?php echo $masp; ?></title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/lte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../assets/lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../assets/lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../assets/lte/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/lte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../assets/lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../assets/lte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../assets/lte/plugins/summernote/summernote-bs4.min.css">

    <!-- my styles -->
    <link rel="stylesheet" href="../assets/admin/css/styles.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <section class="content list-products">
            <div class="container-fluid">
                <?php for ($j = 0; $j <= 5; $j++) : ?>
                    <div class="row">
                        <?php for ($i = 0; $i <= 2; $i++) : ?>
                            <div class="col-4">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                <img src="../assets/image/logo-612x612.png" alt="BKAT Logo" class="brand-image" style="max-width: 50px;">
                                                <span class="brand-text font-weight-light">BKAT</span>
                                            </th>
                                            <th>Tên: <?php echo $record->tensp; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <b>ID: <?php echo $record->masp; ?></b></br>
                                                <?php
                                                $category = $this->getCategory($record->madm);
                                                echo isset($category->tendm) ? $category->tendm : "";
                                                ?>
                                            </td>
                                            <td>Ncc:
                                                <?php
                                                $supplier = $this->getSupplier($record->mancc);
                                                echo isset($supplier->tenncc) ? $supplier->tenncc : "";
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Loại:
                                                <?php if (isset($record->loaisp) && $record->loaisp == 1) : ?>
                                                    Dùng xong bỏ
                                                <?php endif; ?>
                                                <?php if (isset($record->loaisp) && $record->loaisp == 2) : ?>
                                                    Dùng xong trả lại
                                                <?php endif; ?>
                                                <?php if (isset($record->loaisp) && $record->loaisp == 3) : ?>
                                                    Tái sử dụng nhiều lần
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                Ngày nhập: <?php echo $record->ngaynhap; ?></br>
                                                Hạn bảo trì: <?php echo $record->hanbaotri; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </section>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="../assets/lte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../assets/lte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../assets/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../assets/lte/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../assets/lte/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../assets/lte/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../assets/lte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../assets/lte/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../assets/lte/plugins/moment/moment.min.js"></script>
    <script src="../assets/lte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../assets/lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../assets/lte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../assets/lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/lte/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../assets/lte/dist/js/demo.js"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="../assets/lte/dist/js/pages/dashboard.js"></script> -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>