<?php
$this->fileLayout = "Layout.php";
?>
<?php
$matk = $_SESSION["matk"];
$conn = Connection::getInstance();
$query_r = $conn->query("select * from requests where matk = $matk");
$rq = $query_r->fetch();
$query_d = $conn->query("select * from departments where mapb = (select mapb from accounts where matk = $matk)");
$pb = $query_d->fetch();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-8">
                <button type="button" class="btn btn-default"><a href="index.php?controller=request">Trở lại <i class="fas fa-backward"></i></a></button>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Phòng ban</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content list-products">
    <div class="container-fluit">
        <!-- Table row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Danh sách vật tư phòng ban: <?php echo $pb->tenpb; ?></h4>
                        </div>
                        <div class="form-inline float-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">Sắp xếp</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu" style="">
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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Request ID</th>
                                    <th scope="col">Mã sp</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tên vật tư</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Loại vật tư</th>
                                    <th scope="col">Ngày nhập</th>
                                    <th scope="col">Hạn bảo trì</th>
                                    <th scope="col">Số lần sử dụng</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Số lượng có</th>
                                    <th scope="col">Số lượng yêu cầu</th>
                                    <?php if (isset($rq->trangthai) && $rq->trangthai == 1) : ?>
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
                                        <td><?php echo $rows->request_id; ?></td>
                                        <td><?php echo $product->masp; ?></td>
                                        <td><?php if ($product->anhsp != "" && file_exists("../assets/image/upload/products/" . $product->anhsp)) : ?>
                                                <img src="../assets/image/upload/products/<?php echo $product->anhsp; ?>" style="max-width: 100px;">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $product->tensp; ?></td>
                                        <td><?php echo $product->mota; ?></td>
                                        <td>
                                            <?php if (isset($product->loaisp) && $product->loaisp == 1) : ?>
                                                Dùng xong bỏ
                                            <?php endif; ?>
                                            <?php if (isset($product->loaisp) && $product->loaisp == 2) : ?>
                                                Dùng xong trả lại kho
                                            <?php endif; ?>
                                            <?php if (isset($product->loaisp) && $product->loaisp == 3) : ?>
                                                Trang thiết bị
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $product->ngaynhap; ?></td>
                                        <td><?php echo $product->hanbaotri; ?></td>
                                        <td><?php echo $product->solansudung; ?></td>
                                        <td><?php if (isset($rows->trangthai) && $rows->trangthai == 0) : ?>
                                                Tự do
                                            <?php endif; ?>
                                            <?php if (isset($rows->trangthai) && $rows->trangthai == 1) : ?>
                                                Đang được sử dụng
                                            <?php endif; ?>
                                            <?php if (isset($rows->trangthai) && $rows->trangthai == 2) : ?>
                                                Đang bảo trì
                                            <?php endif; ?>
                                            <?php if (isset($rows->trangthai) && $rows->trangthai == 3) : ?>
                                                Hỏng
                                            <?php endif; ?>
                                            <?php if (isset($rows->trangthai) && $rows->trangthai == 4) : ?>
                                                Đã hoàn tất quá trình sử dụng
                                            <?php endif; ?>
                                        </td>
                                        <td><?php
                                            //co the goi ham tu class model o day
                                            $category = $this->getCategory($product->madm);
                                            echo isset($category->tendm) ? $category->tendm : "";
                                            ?></td>
                                        <td><?php echo $product->soluong; ?></td>
                                        <td>
                                            <?php
                                            //co the goi ham tu class model o day
                                            echo isset($rows->soluong) ? $rows->soluong : "";
                                            ?>
                                        </td>
                                        <?php if (isset($rq->trangthai) && $rq->trangthai == 1) : ?>
                                            <td class="d-flex flex-column">
                                                <?php if (isset($rows->trangthai) && $rows->trangthai == 0) : ?>
                                                    <a class="btn btn-info btn-sm" href="index.php?controller=department&action=using&masp=<?php echo $rows->masp; ?>&request_id=<?php echo $rows->request_id; ?>">
                                                        Đang sử dụng
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (isset($rows->trangthai) && $rows->trangthai == 1) : ?>
                                                    <a class="btn btn-success btn-sm" href="index.php?controller=department&action=finished_using&masp=<?php echo $rows->masp; ?>&soluong=<?php echo $rows->soluong; ?>&request_id=<?php echo $rows->request_id; ?>" onclick="return window.confirm('Xác nhận đã sử dụng sản phẩm này?');">
                                                        Hoàn tất
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (isset($rows->trangthai) && $rows->trangthai != 4) : ?>
                                                <a class="btn btn-danger btn-sm" href="index.php?controller=department&action=broken&masp=<?php echo $rows->masp; ?>&request_id=<?php echo $rows->request_id; ?>" onclick="return window.confirm('Xác nhận sản phẩm này lỗi hoặc hỏng?');">
                                                    Báo lỗi/hỏng
                                                </a>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
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
                                    <li class="page-item"><a class="page-link" href="index.php?controller=department&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
</section>