<?php
$this->fileLayout = "Layout.php";
?>
<?php
$conn = Connection::getInstance();
$query = $conn->query("select * from maintenances where mabt = $mabt");
$bt = $query->fetch();
?>
<?php
$account = $this->modelGetAccount($mabt);
$supplier = $this->getSupplier($bt->mancc);
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <button type="button" class="btn btn-default"><a href="index.php?controller=maintenances">Trở lại <i class="fas fa-backward"></i></a></button>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Bảo trì</a> </li>
                    <li class="breadcrumb-item active">Chi tiết bảo trì </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
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
                                <th>Hạn bảo trì mới</th>
                                <th>Chi phí bảo trì</th>
                                <th>Hình thức</th>
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
                                    <td>
                                    <?php if (isset($maintenacedetail->hinhthuc) && $maintenacedetail->hinhthuc == 0) : ?>
                                            Bảo trì/Bảo dưỡng
                                        <?php endif; ?>
                                        <?php if (isset($maintenacedetail->hinhthuc) && $maintenacedetail->hinhthuc == 1) : ?>
                                            Bảo hành
                                        <?php endif; ?>
                                    </td>       
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

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <?php if ($bt->trangthai == 0) : ?>
                        <a href="index.php?controller=maintenances&action=finish_maintenance&mabt=<?php echo $mabt; ?>" class="btn btn-success" onclick="return window.confirm('Bạn có chắc chắn hoàn thành bảo trì này?');"><i class="fas fa-check"></i>Hoàn thành bảo trì</a>
                    <?php endif; ?>
                    <?php if ($bt->trangthai == 1) : ?>
                        <a href="index.php?controller=maintenances&action=print_MaintenanceDetail&mabt=<?php echo $mabt; ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> In hóa đơn bảo trì</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>