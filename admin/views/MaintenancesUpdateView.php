<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=categories">Trở lại <i class="fas fa-backward"></i></a></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh mục</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Table row -->
        <div class="row">
            <div class="col-6">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo $record->masp; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ảnh</td>
                            <td><?php if ($record->anhsp != "" && file_exists("../assets/image/upload/products/" . $record->anhsp)) : ?>
                                    <img src="../assets/image/upload/products/<?php echo $record->anhsp; ?>" style="max-width: 100px;">
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tên vật tư</td>
                            <td><?php echo $record->tensp; ?></td>
                        </tr>
                        <tr>
                            <td>Mô tả</td>
                            <td><?php echo $record->mota; ?></td>
                        </tr>
                        <tr>
                            <td>Giá nhập</td>
                            <td><?php echo number_format($record->gianhap); ?>đ</td>
                        </tr>
                        <tr>
                            <td>Ngày nhập</td>
                            <td><?php echo $record->ngaynhap; ?></td>
                        </tr>
                        <tr>
                            <td>Hạn bảo trì</td>
                            <td><?php echo $record->hanbaotri; ?></td>
                        </tr>
                        <tr>
                            <td>Số lần sử dụng</td>
                            <td><?php echo $record->solansudung; ?></td>
                        </tr>
                        <tr>
                            <td>Trạng thái</td>
                            <td><?php if (isset($record->trangthai) && $record->trangthai == 0) : ?>
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
                                <?php endif; ?></td>
                        </tr>
                        <tr>
                            <td>Số lượng</td>
                            <td><?php echo $record->soluong; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
            <div class="col-6">
                <!-- Default box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">FORM</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="<?php echo $action; ?>">
                        <div class="card-body">
                            <div class="form-group clearfix">
                                <label>Hình thức xử lý: </label>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="hinhthuc" value="0" <?php echo isset($record->hinhthuc) == 0 ? "checked" : ""; ?>>
                                    <label for="radioPrimary1">
                                        Bảo trì/Bảo dưỡng
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="hinhthuc" value="1" <?php echo isset($record->hinhthuc) == 1 ? "checked" : ""; ?>>
                                    <label for="radioPrimary2">
                                        Bảo hành
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="hanbaotrimoi">Hạn bảo hành mới</label>
                                <input type="date" class="form-control" id="hanbaotrimoi" name="hanbaotrimoi" required>
                            </div>
                            <div class="form-group">
                                <label for="chiphi">Chi phí bảo trì</label>
                                <input type="text" class="form-control" id="chiphi" name="chiphi" required>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                    <script>
    // Bắt sự kiện khi chọn Bảo hành
    document.getElementById("radioPrimary2").onclick = function() {
        // Tắt trường Hạn bảo trì mới và Chi phí bảo trì
        document.getElementById("hanbaotrimoi").disabled = false;
        document.getElementById("chiphi").disabled = true;
    };

    // Bắt sự kiện khi chọn Bảo trì/Bảo dưỡng
    document.getElementById("radioPrimary1").onclick = function() {
        // Bỏ tắt trường Hạn bảo trì mới và Chi phí bảo trì
        document.getElementById("hanbaotrimoi").disabled = true;
        document.getElementById("chiphi").disabled = false;
    };
</script>
                </div>
                <!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
    </div>



</section>
<!-- /.content -->