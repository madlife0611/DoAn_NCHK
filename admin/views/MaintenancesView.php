<?php
$this->fileLayout = "Layout.php";
?>
<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="card-body table-responsive p-0">
                    <form action="index.php?controller=maintenance&action=update" method="post">
                        <table class="table table-head-fixed text-wrap">
                            <thead>
                                <tr>
                                    <th class="anh" scope="col">Ảnh</th>
                                    <th class="tensp" scope="col">Tên vật tư</th>
                                    <th class="gianhap" scope="col">Giá nhập</th>
                                    <th class="quantity" scope="col">Số lượng</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($_SESSION['maintenance'] as $product) :
                                ?>
                                    <tr>
                                        <td>
                                            <img src="../assets/image/upload/products/<?php echo $product["anhsp"]; ?>" style="max-width: 100px;">
                                        </td>
                                        <td><?php echo $product["tensp"]; ?></td>
                                        <td><?php echo number_format($product["gianhap"]); ?>đ</td>
                                        <td><?php echo $product["soluong"]; ?></td>
                                        <td>
                                            <a href="index.php?controller=maintenance&action=delete&masp=<?php echo $product["masp"]; ?>" data-id="2479395"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <a href="index.php" class="btn btn-primary btn-sm">Trở lại trang chủ</a>
                                    </td>
                                    <td><a href="index.php?controller=maintenance&action=destroy" class="btn btn-primary btn-sm">Xóa toàn bộ</a></td>
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
                            <h5 class="card-title">VUI LÒNG KIỂM TRA KỸ TRƯỚC KHI XÁC NHẬN BẢO HÀNH</h5>
                            <a href="index.php?controller=maintenance&action=checkout" class="btn btn-primary btn-sm">Xác nhận bảo hành</a>
                        <?php else : ?>
                            <h5 class="card-title">CHƯA CÓ SẢN PHẨM NÀO TRONG DANH SÁCH</h5>
                            <a href="index.php" class="btn btn-primary btn-sm">Trở lại trang chủ</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content list-products">
    <div class="container">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Lịch sử bảo trì</h4>
                        </div>
                        <div class="form-inline float-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">Sắp xếp</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="index.php?controller=products&action=category&madm=<?php echo $madm; ?>&order=idtang">Theo mã
                                        vật tư tăng dần</a>
                                    <a class="dropdown-item" href="index.php?controller=products&action=category&madm=<?php echo $madm; ?>&order=idgiam">Theo mã
                                        vật giảm dần</a>
                                    <a class="dropdown-item" href="index.php?controller=products&action=category&madm=<?php echo $madm; ?>&order=ngaynhapgan">Theo
                                        ngày nhập gần
                                        dần</a>
                                    <a class="dropdown-item" href="index.php?controller=products&action=category&madm=<?php echo $madm; ?>&order=ngaynhapxa">Theo
                                        ngày nhập xa nhất
                                        dần</a>

                                </div>
                            </div>
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
                                            <?php echo $rows->donvibaotri; ?>
                                        </td>
                                        <td>
                                            <?php echo isset($rows->chiphi) ? $rows->chiphi : ""; ?>
                                        </td>
                                        <td>
                                            <?php if ($rows->trangthai == 1) : ?>
                                                <p>Đã xác nhận</p>
                                            <?php else : ?>
                                                <p>Chưa xác nhận</p>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($rows->trangthai == 0) : ?>
                                                <a href="index.php?controller=maintenances&action=delete_maintenance&mabt=<?php echo $mabt; ?>" rel="noopener" target="_blank" class="btn btn-danger btn-sm" onclick="return window.confirm('Bạn có chắc chắn hủy yêu cầu này?');"><i class="fas fa-trash"></i>Hủy yêu cầu</a>
                                            <?php endif; ?>
                                            <a class="btn btn-primary btn-sm" href="index.php?controller=maintenance&action=detail&mabt=<?php echo $rows->mabt; ?>">
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