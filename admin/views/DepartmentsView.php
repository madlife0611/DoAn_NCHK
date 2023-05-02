<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=departments&action=create">Thêm phòng ban mới <i
                            class="fas fa-plus"></i></a></button>
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

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                <?php foreach ($data as $rows): ?>
                    <!-- col -->
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $rows->tenpb; ?>
                                </h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Tổng số lượng vật tư đang sử dụng: <span
                                        class="text-danger float-right">111</span></li>
                                <li class="list-group-item">Tổng tài khoản nhân viên: <span
                                        class="text-danger float-right">111</span></li>
                                <li class="list-group-item">Số lượng request: <span
                                        class="text-danger float-right">111</span></li>
                            </ul>
                            <div class="card-body">
                                <a class="btn btn-primary btn-sm" href="index.php?controller=departments&action=view&mapb=<?php echo $rows->mapb; ?>">
                                    <i class="fas fa-eye">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="index.php?controller=departments&action=update&mapb=<?php echo $rows->mapb; ?>">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="index.php?controller=departments&action=delete&mapb=<?php echo $rows->mapb; ?>" onclick="return window.confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                <?php endforeach; ?>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <nav aria-label="Contacts Page Navigation">
                <ul class="pagination justify-content-center m-0">
                    <?php for ($i = 1; $i <= $numPage; $i++): ?>
                        <li class="page-item"><a class="page-link"
                                href="index.php?controller=departments&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->