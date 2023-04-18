<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lịch sử thay đổi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Lịch sử thay đổi</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content list-products">
    <div class="container-fluid">
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
                                    <a class="dropdown-item" href="#">Theo ngày thay đổi gần dần</a>
                                    <a class="dropdown-item" href="#">Theo ngày thay đổi xa nhất dần</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-inline float-right">
                            <div class="input-group" data-widget="sidebar-search">
                                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                                    aria-label="Search" id="key">
                                <div class="input-group-append">
                                    <button class="btn btn-default" id="btnSearchForAdmin">
                                        <i class="fas fa-fw fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="sidebar-search-results">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="search-title">
                                            <strong class="text-light"></strong>Không tìm thấy vật tư nào!
                                        </div>
                                        <ul>
                                            <li><a href="#">Sản phẩm 1</a></li>
                                            <li><a href="#">Sản phẩm 2</a></li>
                                            <li><a href="#">Sản phẩm 3</a></li>
                                        </ul>
                                        <div class="search-path"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 500px;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên bảng</th>
                                    <th>Giờ cập nhật</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Email người cập nhật</th>
                                    <th>Trạng thái cập nhật</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $rows): ?>
                                    <tr>
                                        <td>
                                            <?php echo $rows->macl; ?>
                                        </td>
                                        <td>
                                            <?php echo $rows->tenbang; ?>
                                        </td>
                                        <td>
                                            <?php echo date("H:i:s", strtotime($rows->thoigian)); ?>
                                        </td>
                                        <td>
                                            <?php echo date("Y-m-d", strtotime($rows->thoigian)); ?>
                                        </td>
                                        <td>
                                            <?php
                                            $account = $this->getAccount($rows->matk);
                                            echo isset($account->hoten) ? $account->hoten : "";
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $rows->trangthaithaydoi; ?>
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-eye">
                                                </i>
                                                View
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
                                            href="index.php?controller=products&p=<?php echo $i; ?>"><?php echo $i; ?></a>
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