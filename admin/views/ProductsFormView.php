<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=products">Trở lại <i class="fas fa-backward"></i></a></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Cập nhật sản phẩm</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">FORM</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="tensp">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="tensp" name="tensp" value="<?php echo isset($record->tensp) ? $record->tensp : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="anhsp">Ảnh sản phẩm</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" id="anhsp" name="anhsp">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mota">Mô tả sản phẩm</label>
                    <input type="text" class="form-control" id="mota" name="mota" value="<?php echo isset($record->mota) ? $record->mota : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="soluong">Số lượng</label>
                    <input type="text" class="form-control" id="soluong" name="soluong" value="<?php echo isset($record->soluong) ? $record->soluong : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="gianhap">Giá nhập</label>
                    <input type="text" class="form-control" id="gianhap" name="gianhap" value="<?php echo isset($record->gianhap) ? $record->gianhap : ""; ?>">
                </div>
                <div class="form-group">
                    <label>Ngày nhập</label>
                    <div class="input-group date">
                        <input type="date" name="ngaynhap" value="<?php echo isset($record->ngaynhap) ? $record->ngaynhap : ""; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label>Ngày bảo trì</label>
                    <div class="input-group date">
                        <input type="date" class="form-control" name="hanbaotri" value="<?php echo isset($record->hanbaotri) ? $record->hanbaotri : ""; ?>">
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label>Trạng thái</label>
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary1" name="trangthai" value="0" <?php echo isset($record->trangthai) == 0 ? "checked" : ""; ?>>
                        <label for="radioPrimary1">
                            Tự do
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary2" name="trangthai" value="1" <?php echo isset($record->trangthai) == 1 ? "checked" : ""; ?>>
                        <label for="radioPrimary2">
                            Đang sử dụng
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary3" name="trangthai" value="2" <?php echo isset($record->trangthai) == 2 ? "checked" : ""; ?>>
                        <label for="radioPrimary3">
                            Đang bảo trì
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary4" name="trangthai" value="3" <?php echo isset($record->trangthai) == 3 ? "checked" : ""; ?>>
                        <label for="radioPrimary4">
                            Hỏng
                        </label>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label>Loại vật tư</label>
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="radio1" name="loaisp" value="1" <?php echo isset($record->loaisp) == 1 ? "checked" : ""; ?>>
                        <label for="radio1">
                            Dùng xong bỏ
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="radio2" name="loaisp" value="2" <?php echo isset($record->loaisp) == 2 ? "checked" : ""; ?>>
                        <label for="radio2">
                            Dùng xong trả lại
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="radio3" name="loaisp" value="3" <?php echo isset($record->loaisp) == 3 ? "checked" : ""; ?>>
                        <label for="radio3">
                            Tái sử dụng nhiều lần
                        </label>
                    </div>
                </div>
                <?php $ncc = $this->modelSuppliers(); ?>
                <div class="form-group">
                    <label for="nhacungcap">Nhà cung cấp</label>
                    <select class="custom-select form-control-border" name="mancc" id="nhacungcap">
                        <?php foreach ($ncc as $rows) : ?>
                            <option <?php if (isset($record->mancc) && $record->mancc == $rows->mancc) : ?> selected <?php endif; ?> value="<?php echo $rows->mancc; ?>"><?php echo $rows->tenncc; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php $danhmuc = $this->modelCategories(); ?>
                <div class="form-group">
                    <label for="danhmuc">Danh mục</label>
                    <select class="custom-select form-control-border" name="madm" id="danhmuc">
                        <?php foreach ($danhmuc as $rows) : ?>
                            <option <?php if (isset($record->madm) && $record->madm == $rows->madm) : ?> selected <?php endif; ?> value="<?php echo $rows->madm; ?>"><?php echo $rows->tendm; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->