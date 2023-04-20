<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=categories&action=create">Thêm vật tư mới <i
                            class="fas fa-plus"></i></a></button>
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
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                <?php foreach ($data as $rows): ?>
                    <!-- col -->
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $rows->tendm; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $rows->mota; ?>
                                </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Tổng số lượng vật tư: <span
                                        class="text-danger float-right">111</span></li>
                                <li class="list-group-item">Tổng vật tư sắp đến hạn bảo hành: <span
                                        class="text-danger float-right">111</span></li>
                                <li class="list-group-item">Tổng vật tư đang được sử dụng: <span
                                        class="text-danger float-right">111</span></li>
                            </ul>
                            <div class="card-body">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-eye">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="index.php?controller=categories&action=update&madm=<?php echo $rows->madm; ?>">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="index.php?controller=categories&action=delete&madm=<?php echo $rows->madm; ?>" onclick="return window.confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
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
                                href="index.php?controller=categories&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->