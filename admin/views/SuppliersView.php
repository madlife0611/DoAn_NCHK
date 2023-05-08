<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" class="btn btn-default"><a href="index.php?controller=suppliers&action=create">Thêm nhà cung cấp mới <i class="fas fa-plus"></i></a></button>
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
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                <?php foreach ($data as $rows) : ?>
                    <!-- col -->
                    <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                Mã nhà cung cấp:
                                <?php echo $rows->mancc; ?>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>
                                                <?php echo $rows->tenncc; ?>
                                            </b></h2>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Địa chỉ:
                                                <?php echo $rows->diachi; ?>
                                            </li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-at"></i></span> Email:
                                                <?php echo $rows->email; ?>
                                            </li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                                Số điện thoại:
                                                <?php echo $rows->sdt; ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Tổng số vật tư còn lại: <span class="text-danger float-right"><?php echo $this->modelTotalProducts($rows->mancc); ?></span></li>
                                            <li class="list-group-item">Số vật tư tới hạn bảo trì trong 2 tuần tới: <span class="text-danger float-right"><?php echo $this->modelTotalMaintenanceProductsOn14Days($rows->mancc); ?></span></li>
                                            <li class="list-group-item">Số bảo trì đang thực hiện: <span class="text-danger float-right"><?php echo $this->modelTotalMaintenance($rows->mancc); ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">

                                <a class="btn btn-primary btn-sm" href="index.php?controller=suppliers&action=view&mancc=<?php echo $rows->mancc; ?>">
                                    <i class="fas fa-eye">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="index.php?controller=suppliers&action=update&mancc=<?php echo $rows->mancc; ?>">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="index.php?controller=suppliers&action=delete&mancc=<?php echo $rows->mancc; ?>" onclick="return window.confirm('Bạn có chắc chắn muốn xóa nhà cung cấp này?');">
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
                    <?php for ($i = 1; $i <= $numPage; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="index.php?controller=suppliers&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->