<?php
$this->fileLayout = "Layout.php";
?><?php $ncc = $this->getSupplier($this->maintenanceSupplier()); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <div class="card-body table-responsive p-0">
                    <form action="index.php?controller=maintenances&action=update" method="post">
                        <table class="table table-head-fixed text-wrap">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th class="anh" scope="col">Ảnh</th>
                                    <th class="tensp" scope="col">Tên vật tư</th>
                                    <th class="gianhap" scope="col">Giá nhập</th>
                                    <th class="quantity" scope="col">Số lượng</th>
                                    <th class="" scope="col">Hạn bảo trì</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($_SESSION['maintenance'] as $product) :
                                ?>
                                    <tr>
                                        <td><?php echo $product["masp"]; ?></td>
                                        <td>
                                            <img src="../assets/image/upload/products/<?php echo isset($product["anhsp"]) ? $product["anhsp"] : ""; ?>" style="max-width: 100px;">
                                        </td>
                                        <td><?php echo isset($product["tensp"]) ? $product["tensp"] : ""; ?></td>
                                        <td><?php echo isset($product["gianhap"]) ? number_format($product["gianhap"]) : ""; ?>đ</td>
                                        <td><?php echo isset($product["soluong"]) ? $product["soluong"] : ""; ?></td>
                                        <td><?php echo isset($product["hanbaotri"]) ? $product["hanbaotri"] : ""; ?></td>
                                        <td>
                                            <a href="index.php?controller=maintenances&action=delete&masp=<?php echo isset($product["masp"]) ? $product["masp"] : ""; ?>" data-id="2479395"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <a href="index.php?controller=suppliers&action=view&mancc=<?php echo $ncc->mancc; ?>" class="btn btn-primary btn-sm">Trở lại nhà cung cấp</a>
                                    </td>
                                    <td><a href="index.php?controller=maintenances&action=destroy" class="btn btn-primary btn-sm">Xóa toàn bộ</a></td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <?php if ($this->maintenanceNumber() > 0) : ?>
                            
                            <h5 class="card-title">Nhà cung cấp: <?php echo $ncc->tenncc; ?></h5>
                            <a href="index.php?controller=maintenances&action=checkout" class="btn btn-primary btn-sm">Xác nhận bảo hành</a>
                        <?php else : ?>
                            <h5 class="card-title">CHƯA CÓ SẢN PHẨM NÀO TRONG DANH SÁCH</h5>
                            <a href="index.php?controller=suppliers" class="btn btn-primary btn-sm">Trở lại nhà cung cấp</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content list-products">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Lịch sử bảo trì</h4>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 500px;">
                        <table class="table table-head-fixed text-wrap">
                            <thead>
                                <tr>
                                    <th>Mã bảo trì</th>
                                    <th>Ngày bảo trì</th>
                                    <th>Đơn vị bảo trì</th>
                                    <th>Tổng chi phí</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $rows) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $rows->mabt; ?>
                                        </td>
                                        <td>
                                            <?php echo date("d/m/Y", strtotime($rows->ngaybaotri)); ?>
                                        </td>
                                        <td>
                                        <?php $ncc = $this->getSupplier($rows->mancc);
                                            echo $ncc->tenncc;
                                        ?>
                                        </td>
                                        <td>
                                            <?php echo isset($rows->tongchiphi) ? $rows->tongchiphi : ""; ?>
                                        </td>
                                        <td>
                                            <?php if ($rows->trangthai == 1) : ?>
                                                <p>Đã hoàn thành bảo trì</p>
                                            <?php else : ?>
                                                <p>Chưa hoàn thành</p>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center d-flex flex-column">
                                            <a class="btn btn-primary btn-sm" href="index.php?controller=maintenances&action=detail&mabt=<?php echo $rows->mabt; ?>">
                                                <i class="fas fa-eye">
                                                </i>
                                                Xem chi tiết
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <nav aria-label="Contacts Page Navigation">
                            <ul class="pagination justify-content-center m-0">
                                <?php for ($i = 1; $i <= $numPage; $i++) : ?>
                                    <li class="page-item"><a class="page-link" href="index.php?controller=maintenance&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>