<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=suppliers">Trở lại <i class="fas fa-backward"></i></a></button>
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
        <form method="post" action="<?php echo $action; ?>">
            <div class="card-body">
                <div class="form-group">
                    <label for="tenncc">Tên nhà cung cấp</label>
                    <input type="text" class="form-control" id="tenncc" name="tenncc" value="<?php echo isset($record->tenncc) ? $record->tenncc : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email nhà cung cấp</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($record->email) ? $record->email : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="diachi">Địa chỉ nhà cung cấp</label>
                    <input type="text" class="form-control" id="diachi" name="diachi" value="<?php echo isset($record->diachi) ? $record->diachi : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="sdt">Số điện thoại nhà cung cấp</label>
                    <input type="text" class="form-control" id="sdt" name="sdt" value="<?php echo isset($record->sdt) ? $record->sdt : ""; ?>">
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