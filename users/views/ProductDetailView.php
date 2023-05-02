<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=products">Trở lại <i class="fas fa-backward"></i></a></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item">Vật tư</li>
                    <li class="breadcrumb-item active">Chi tiết vật tư</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content list-products">
    <div class="container">
        <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none"><?php echo $record->tensp; ?></h3>
                    <div class="col-12">
                        <img src="../assets/image/upload/products/<?php echo $record->anhsp; ?>" class="product-image" alt="Product Image">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3"><?php echo $record->tensp; ?></h3>
                    <p><?php echo $record->mota; ?></p>
                    <hr>
                    <p><b>Danh mục:</b>
                        <?php
                        $category = $this->getCategory($record->madm);
                        echo isset($category->tendm) ? $category->tendm : "";
                        echo ": ";
                        echo isset($category->mota) ? $category->mota : "";
                        ?>
                    </p>
                    <p><b>Nhà cung cấp:</b>
                        <?php
                        $supplier = $this->getSupplier($record->mancc);
                        echo isset($supplier->tenncc) ? $supplier->tenncc : "";
                        ?>
                    </p>
                    <p><b>Số lượng có:</b>
                        <?php echo $record->soluong; ?>
                    </p>
                    <p><b>Giá nhập:</b>
                        <?php echo number_format($record->gianhap); ?> đ
                    </p>
                    <p><b>Ngày nhập:</b>
                        <?php echo $record->ngaynhap; ?>
                    </p>
                    <p><b>Hạn bảo trì:</b>
                        <?php echo $record->hanbaotri; ?>
                    </p>
                    <p><b>Tần suất sử dụng:</b>
                        <?php echo $record->tansuatsudung; ?> giờ/ngày
                    </p>
                    <p><b>Số lần sử dụng:</b>
                        <?php echo $record->solansudung; ?>
                    </p>
                    <p><b>Trạng thái:</b>
                        <?php if (isset($record->trangthai) && $record->trangthai == 0) : ?>
                            Tự do
                        <?php endif; ?>
                        <?php if (isset($record->trangthai) && $record->trangthai == 1) : ?>
                            Đang được sử dụng
                        <?php endif; ?>
                        <?php if (isset($record->trangthai) && $record->trangthai == 2) : ?>
                            Đang bảo trì
                        <?php endif; ?>
                        <?php if (isset($record->trangthai) && $record->trangthai == 3) : ?>
                            Hỏng
                        <?php endif; ?>
                    </p>
                    <p><b>Loại sản phẩm:</b>
                        <?php if (isset($record->loaisp) && $record->loaisp == 1) : ?>
                            Dùng xong bỏ
                        <?php endif; ?>
                        <?php if (isset($record->loaisp) && $record->loaisp == 2) : ?>
                            Dùng xong trả lại
                        <?php endif; ?>
                        <?php if (isset($record->loaisp) && $record->loaisp == 3) : ?>
                            Tái sử dụng nhiều lần
                        <?php endif; ?>
                    </p>

                </div>
            </div>
    </div>
</section>