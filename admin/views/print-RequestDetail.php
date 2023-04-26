<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request_Detail_<?php echo $request_id; ?></title>
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
        <?php
        $account = $this->modelGetAccount($request_id);
        $account_admin = $this->modelGetAccountAdmin($request_id);
        ?>
        <section class="content list-products">
            <div class="container-fluid">
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> BKAT, Inc.
                                <small class="float-right">Date: <?php
                                if ($rq->trangthai == 1) {
                                    echo date("d-m-Y", strtotime($rq->ngayxacnhan));
                                } else {
                                    echo date("d/m/Y");
                                } ?></small>
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

                        <!-- /.col -->
                        <?php
                        $conn = Connection::getInstance();
                        $query = $conn->query("select * from requests where request_id = $request_id");
                        $rq = $query->fetch();
                        ?>
                        <div class="col-sm-4 invoice-col">
                            <?php if ($rq->trangthai == 1) : ?>
                                Người xác nhận
                                <address>
                                    <strong><?php
                                            echo isset($account_admin->hoten) ? $account_admin->hoten : "";
                                            ?></strong><br>
                                    Phòng ban:
                                    <?php
                                    $department = $this->modelGetDepartment($account_admin->mapb);
                                    echo isset($department->tenpb) ? $department->tenpb : "";
                                    ?><br>
                                    Email:
                                    <?php
                                    echo isset($account_admin->email) ? $account_admin->email : "";
                                    ?><br>
                                    Địa chỉ:
                                    <?php
                                    echo isset($account_admin->diachi) ? $account_admin->diachi : "";
                                    ?><br>
                                    SĐT:
                                    <?php
                                    echo isset($account_admin->sdt) ? $account_admin->sdt : "";
                                    ?>
                                </address>
                            <?php else : ?>
                                Chưa xác nhận
                            <?php endif; ?>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Phiếu xuất hóa đơn
                            <address>
                                <strong>Mã request:<?php
                                                    echo $request_id;
                                                    ?></strong><br>
                                Ngày lập:
                                <?php
                                echo date("d-m-Y", strtotime($rq->ngaylap));
                                ?><br>
                                Ngày xác nhận:
                                <?php
                                if ($rq->trangthai == 1) {
                                    echo date("d-m-Y", strtotime($rq->ngayxacnhan));
                                } else {
                                    echo "Chưa xác nhận";
                                }
                                ?><br>
                                Tổng tiền:
                                <?php
                                echo number_format($rq->tongtien);
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
                                        <th>ID</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Tên vật tư</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Giá nhập</th>
                                        <th scope="col">Ngày nhập</th>
                                        <th scope="col">Hạn bảo trì</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Nhà cung cấp</th>
                                        <th scope="col">Số lượng có</th>
                                        <th scope="col">Số lượng yêu cầu</th>
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
                                            <td><?php
                                                //co the goi ham tu class model o day
                                                $category = $this->getCategory($product->madm);
                                                echo isset($category->tendm) ? $category->tendm : "";
                                                ?></td>
                                            <td><?php
                                                //co the goi ham tu class model o day
                                                $supplier = $this->getSupplier($product->mancc);
                                                echo isset($supplier->tenncc) ? $supplier->tenncc : "";
                                                ?></td>
                                            <td><?php echo $product->soluong; ?></td>
                                            <td>
                                                <?php
                                                //co the goi ham tu class model o day
                                                $requestdetail = $this->modelGetRequestsDetail($rows->request_id, $product->masp);
                                                echo isset($requestdetail->soluong) ? $requestdetail->soluong : "";
                                                ?>
                                            </td>
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