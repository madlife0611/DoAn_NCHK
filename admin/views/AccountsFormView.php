<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=accounts">Trở lại <i
                            class="fas fa-backward"></i></a></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Nhà cung cấp</li>
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
                    <label for="tenncc">Họ tên</label>
                    <input type="text" class="form-control" id="hoten" name="hoten"
                        value="<?php echo isset($record->hoten) ? $record->hoten : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                        value="<?php echo isset($record->email) ? $record->email : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" <?php if (isset($record->email)): ?>
                            placeholder="Không đổi password thì không nhập thông tin vào ô textbox này" <?php else: ?>
                            required <?php endif; ?>>
                </div>
                <div class="form-group">
                    <label for="diachi">Địa chỉ</label>
                    <input type="text" class="form-control" id="diachi" name="diachi"
                        value="<?php echo isset($record->diachi) ? $record->diachi : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" class="form-control" id="sdt" name="sdt"
                        value="<?php echo isset($record->sdt) ? $record->sdt : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="photo">Ảnh đại diện</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photo" id="photo">
                            <label class="custom-file-label" for="photo">Chosse file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div>
                <?php $phongban = $this->modelDepartment(); ?>
                <div class="form-group">
                    <label for="phongban">Phòng ban</label>
                    <select class="custom-select form-control-border" name="mapb" id="phongban">
                        <?php foreach ($phongban as $rows): ?>
                            <option <?php if (isset($record->mapb) && $record->mapb == $rows->mapb): ?> selected <?php endif; ?> value="<?php echo $rows->mapb; ?>"><?php echo $rows->tenpb; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="isAdmin" name="isAdmin" <?php if (isset($record->isAdmin) && $record->isAdmin == 1): ?> checked <?php endif; ?>>
                    <label class="form-check-label" for="isAdmin">Thêm quyền quản lý</label>
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