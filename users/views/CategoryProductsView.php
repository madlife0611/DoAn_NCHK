<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-9">
                <h3><?php 
            //co the goi ham tu class model o day
            $category = $this->getCategory($madm);
            echo isset($category->tendm) ? $category->tendm : "";
         ?>: <?php echo isset($category->mota) ? $category->mota : "";?></h3>
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh mục</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content list-products">
    <div class="container">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">Sắp xếp</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown" aria-expanded="false">
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
                                    <th>Nhà cung cấp</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $rows): ?>
                                    <tr>
                                        <td>
                                            <?php echo $rows->masp; ?>
                                        </td>
                                        <td><img src="../assets/image/upload/products/<?php echo $rows->anhsp; ?>"
                                                alt="product-img" class="img-product"></td>
                                        <td>
                                            <?php echo $rows->tensp; ?>
                                        </td>
                                        <td>
                                            <?php echo $rows->mota; ?>
                                        </td>
                                        <td>
                                            <?php if (isset($rows->loaisp) && $rows->loaisp == 1) : ?>
                                                Dùng xong bỏ
                                            <?php endif; ?>
                                            <?php if (isset($rows->loaisp) && $rows->loaisp == 2) : ?>
                                                Dùng xong trả lại kho
                                            <?php endif; ?>
                                            <?php if (isset($rows->loaisp) && $rows->loaisp == 3) : ?>
                                                Trang thiết bị
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $rows->soluong; ?>
                                        </td>
                                        <td>
                                            <?php echo date("Y-m-d", strtotime($rows->ngaynhap)); ?>
                                        </td>
                                        <td>
                                            <?php
                                            //co the goi ham tu class model o day
                                            $supplier = $this->getSupplier($rows->mancc);
                                            echo isset($supplier->tenncc) ? $supplier->tenncc : "";
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="index.php?controller=products&action=detail&masp=<?php echo $rows->masp; ?>">
                                                <i class="fas fa-eye">
                                                </i>
                                                Xem chi tiết
                                            </a>
                                            <a class="btn btn-info btn-sm"
                                                href="index.php?controller=request&action=create&masp=<?php echo $rows->masp; ?>">
                                                <i class="fas fa-plus"></i>
                                                Thêm vào yêu cầu sử dụng
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
                                <?php for ($i = 1; $i <= $numPage; $i++): ?>
                                    <li class="page-item"><a class="page-link"
                                            href="index.php?controller=products&action=category&madm=<?php echo $madm; ?>&p=<?php echo $i; ?>"><?php echo $i; ?></a>
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