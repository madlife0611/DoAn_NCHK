<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance_Detail_<?php echo $mabt; ?></title>
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
<?php
$conn = Connection::getInstance();
$query = $conn->query("select * from maintenances where mabt = $mabt");
$bt = $query->fetch();
?>
<?php
$account = $this->modelGetAccount($mabt);
$supplier = $this->getSupplier($bt->mancc);
?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    <section class="content list-products">
    <div class="container-fluit">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> BKAT, Inc.
                        <small class="float-right">Date:
                            <?php
                            echo date("d/m/Y");
                            ?>
                        </small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Người yêu cầu
                    <address>
                        <strong><?php
                                echo isset($account->hoten) ? $account->hoten : "";
                                ?></strong><br>
                        Phòng ban:
                        <?php
                        $department = $this->modelGetDepartment($account->mapb);
                        echo isset($department->tenpb) ? $department->tenpb : "";
                        ?><br>
                        Email:
                        <?php
                        echo isset($account->email) ? $account->email : "";
                        ?><br>
                        Địa chỉ:
                        <?php
                        echo isset($account->diachi) ? $account->diachi : "";
                        ?><br>
                        SĐT:
                        <?php
                        echo isset($account->sdt) ? $account->sdt : "";
                        ?>
                    </address>
                </div>


                <div class="col-sm-4 invoice-col">
                        Đơn vị bảo trì
                        <address>
                            <strong><?php
                                    echo isset($supplier->tenncc) ? $supplier->tenncc : "";
                                    ?></strong><br>
                            Email:
                            <?php
                            echo isset($supplier->email) ? $supplier->email : "";
                            ?><br>
                            Địa chỉ:
                            <?php
                            echo isset($supplier->diachi) ? $supplier->diachi : "";
                            ?><br>
                            SĐT:
                            <?php
                            echo isset($supplier->sdt) ? $supplier->sdt : "";
                            ?>
                        </address>

                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Phiếu xuất hóa đơn
                    <address>
                        <strong>Mã bảo trì:<?php
                                            echo $mabt;
                                            ?></strong><br>
                        Ngày bảo trì:
                        <?php
                        echo date("d-m-Y", strtotime($bt->ngaybaotri));
                        ?><br>
                        Tổng chi phí:
                        <?php
                        echo number_format($bt->tongchiphi);
                        ?>đ
                    </address>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên vật tư</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Giá nhập</th>
                                <th scope="col">Ngày nhập</th>
                                <th scope="col">Hạn bảo trì</th>
                                <th scope="col">Số lần sử dụng</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Số lượng</th>
                                <?php if ($bt->trangthai == 1) : ?>
                                    <th>Hạn bảo trì mới</th>
                                    <th>Chi phí bảo trì</th>
                                <?php endif; ?>
                                <?php if ($bt->trangthai == 0) : ?>
                                    <th></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $rows) : ?>
                                <?php
                                $product = $this->modelGetProduct($rows->masp);
                                ?>
                                <tr>
                                    <td><?php echo $product->masp; ?></td>
                                    <td><?php if ($product->anhsp != "" && file_exists("../assets/image/upload/products/" . $product->anhsp)) : ?>
                                            <img src="../assets/image/upload/products/<?php echo $product->anhsp; ?>" style="max-width: 100px;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $product->tensp; ?></td>
                                    <td><?php echo $product->mota; ?></td>
                                    <td><?php echo number_format($product->gianhap); ?>đ</td>
                                    <td><?php echo $product->ngaynhap; ?></td>
                                    <td><?php echo $product->hanbaotri; ?></td>
                                    <td><?php echo $product->solansudung; ?></td>
                                    <td><?php if (isset($product->trangthai) && $product->trangthai == 0) : ?>
                                            Tự do
                                        <?php endif; ?>
                                        <?php if (isset($product->trangthai) && $product->trangthai == 1) : ?>
                                            Đang được sử dụng
                                        <?php endif; ?>
                                        <?php if (isset($product->trangthai) && $product->trangthai == 2) : ?>
                                            Đang bảo trì
                                        <?php endif; ?>
                                        <?php if (isset($product->trangthai) && $product->trangthai == 3) : ?>
                                            Hỏng
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $product->soluong; ?></td>
                                    <?php if ($bt->trangthai == 1) : ?>
                                        <?php
                                        $maintenacedetail = $this->modelGetMaintenancesDetail($rows->mabt, $product->masp);
                                        ?>
                                        <td>
                                        <?php
                                        echo isset($maintenacedetail->hanbaotrimoi) ? $maintenacedetail->hanbaotrimoi : "";
                                        ?>
                                        </td>
                                        <td>
                                        <?php
                                        echo isset($maintenacedetail->chiphi) ? number_format($maintenacedetail->chiphi) : "";
                                        ?>đ
                                        </td>
                                    <?php endif; ?>
                                    <?php if ($bt->trangthai == 0) : ?>
                                        <td class="d-flex flex-column">
                                            <?php if (isset($product->trangthai) && $product->trangthai == 2) : ?>
                                                <a class="btn btn-info btn-sm" href="index.php?controller=maintenances&action=update_detail&masp=<?php echo $rows->masp; ?>&mabt=<?php echo $rows->mabt; ?>">
                                                    Cập nhật thông tin mới
                                                </a>
                                            <?php endif; ?>

                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
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