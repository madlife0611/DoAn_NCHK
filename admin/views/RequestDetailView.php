<?php
$this->fileLayout = "Layout.php";
?>
<?php
$account = $this->modelGetAccount($request_id);
$account_admin = $this->modelGetAccountAdmin($request_id);
?>
<?php
$conn = Connection::getInstance();
$query = $conn->query("select * from requests where request_id = $request_id");
$rq = $query->fetch();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=requests">Trở lại <i class="fas fa-backward"></i></a></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Yêu cầu sử dụng</a> </li>
                    <li class="breadcrumb-item active">Chi tiết yêu cầu </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content list-products">
    <div class="container-fluid">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> BKAT, Inc.
                        <small class="float-right">Date:
                            <?php
                            if ($rq->trangthai == 1) {
                                echo date("d-m-Y", strtotime($rq->ngayxacnhan));
                            } else {
                                echo date("d/m/Y");
                            } ?>
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
                                <th scope="col">ID</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên vật tư</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Giá nhập</th>
                                <th scope="col">Ngày nhập</th>
                                <th scope="col">Hạn bảo trì</th>
                                <th scope="col">Số lần sử dụng</th>
                                <th scope="col">Trạng thái</th>
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
                                    <td><?php echo $product->solansudung; ?></td>
                                    <td><?php if (isset($rows->trangthaivattu) && $rows->trangthaivattu == 0) : ?>
                                            Tự do
                                        <?php endif; ?>
                                        <?php if (isset($rows->trangthaivattu) && $rows->trangthaivattu == 1) : ?>
                                            Đang được sử dụng
                                        <?php endif; ?>
                                        <?php if (isset($rows->trangthaivattu) && $rows->trangthaivattu == 2) : ?>
                                            Đang bảo trì
                                        <?php endif; ?>
                                        <?php if (isset($rows->trangthaivattu) && $rows->trangthaivattu == 3) : ?>
                                            Lỗi/Hỏng
                                        <?php endif; ?>
                                        <?php if (isset($rows->trangthaivattu) && $rows->trangthaivattu == 4) : ?>
                                            Hoàn tất quá trình sử dụng
                                        <?php endif; ?>
                                    </td>
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

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <?php if ($rq->trangthai == 1) : ?>
                        <a href="index.php?controller=requests&action=print_requestDetail&request_id=<?php echo $request_id; ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <?php endif; ?>
                    <?php if ($rq->trangthai == 0) : ?>
                        <a href="index.php?controller=requests&action=delivery&request_id=<?php echo $request_id; ?>" class="btn btn-success float-right">Xác nhận yêu cầu</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>