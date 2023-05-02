<?php
$this->fileLayout = "Layout.php";
?>
<?php 
    $db = Connection::getInstance();
    //thuc hien truy van
    $query = $db->query("select tenpb from departments where mapb = $mapb");
    //tra ve so luong ban ghi
    $tenpb = $query->fetchColumn();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=departments">Trở lại <i
                            class="fas fa-backward"></i></a></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Phòng ban</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content list-products">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Phòng ban: <?php echo $tenpb; ?></h4>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 500px;">
                        <table class="table table-head-fixed text-wrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 100px;">Ảnh</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Loại vật tư</th>
                                    <th>Số lượng</th>
                                    <th>Ngày nhập</th>
                                    <th>Ngày bảo trì</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $rows) : ?>
                                    <?php
                                    $db = Connection::getInstance();
                                    //chuan bi truy van
                                    $masp = $rows->masp;
                                    $query = $db->query("select * from products where masp=$masp");
                                    $prod = $query->fetch();
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $rows->masp; ?>
                                        </td>
                                        <td><img src="../assets/image/upload/products/<?php echo $prod->anhsp; ?>" alt="product-img" class="img-product"></td>
                                        <td>
                                            <?php echo $prod->tensp; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod->mota; ?>
                                        </td>
                                        <td>
                                            <?php if (isset($prod->loaisp) && $prod->loaisp == 1) : ?>
                                                Dùng xong bỏ
                                            <?php endif; ?>
                                            <?php if (isset($prod->loaisp) && $prod->loaisp == 2) : ?>
                                                Dùng xong trả lại kho
                                            <?php endif; ?>
                                            <?php if (isset($prod->loaisp) && $prod->loaisp == 3) : ?>
                                                Trang thiết bị
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $rows->soluong; ?>
                                        </td>
                                        <td>
                                            <?php echo date("Y-m-d", strtotime($prod->ngaynhap)); ?>
                                        </td>
                                        <td>
                                            <?php echo $prod->hanbaotri; ?>
                                        </td>
                                        <td>
                                            <?php if (isset($rows->trangthai) && $rows->trangthai == 0) : ?>
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
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-primary btn-sm" href="index.php?controller=products&action=detail&masp=<?php echo $rows->masp; ?>">
                                                <i class="fas fa-eye">
                                                </i> Xem chi tiết
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
                                    <li class="page-item"><a class="page-link" href="index.php?controller=categories&action=view&madm=<?php echo $madm; ?>&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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