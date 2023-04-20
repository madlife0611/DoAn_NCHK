<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=categories">Trở lại <i
                            class="fas fa-backward"></i></a></button>
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
                    <label for="tendm">Tên danh mục</label>
                    <input type="text" class="form-control" id="tendm" name="tendm"
                        value="<?php echo isset($record->tendm) ? $record->tendm : ""; ?>">
                </div>
                <div class="form-group">
                    <label for="mota">Mô tả</label>
                    <input type="text" class="form-control" id="mota" name="mota"
                        value="<?php echo isset($record->mota) ? $record->mota : ""; ?>">
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