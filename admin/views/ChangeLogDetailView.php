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
            <div class="col-4">
                <?php
                $account = $this->getAccount($record->matk);
                ?>
                <div class="card bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                        Phòng ban:
                        <?php
                        $department = $this->getDepartment($account->mapb);
                        echo isset($department->tenpb) ? $department->tenpb : "";
                        ?>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><b>
                                        <?php
                                        echo isset($account->hoten) ? $account->hoten : "";
                                        ?>
                                    </b></h2>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                        Địa chỉ:
                                        <?php
                                        echo isset($account->diachi) ? $account->diachi : "";
                                        ?>

                                    </li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-at"></i></span> Email:
                                        <?php
                                        echo isset($account->email) ? $account->email : "";
                                        ?>
                                    </li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Số
                                        điện thoại:
                                        <?php
                                        echo isset($account->sdt) ? $account->sdt : "";
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <img src="../assets/image/upload/accounts/<?php echo $account->photo; ?>"
                                    alt="user-avatar" class="img-circle img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-user-cog"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end card -->

            </div>
            <div class="col-8">
                <div class="card bg-light d-flex flex-fill">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <tbody>
                                <tr>
                                    <td>
                                        Mã changelog
                                    </td>
                                    <td>
                                        <?php
                                        echo $record->macl;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tên bảng
                                    </td>
                                    <td>
                                        <?php
                                        echo $record->tenbang;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Giờ cập nhật
                                    </td>
                                    <td>
                                        <?php
                                        echo date("H:i:s", strtotime($record->thoigian));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Ngày cập nhật
                                    </td>
                                    <td>
                                        <?php
                                        echo date("Y-m-d", strtotime($record->thoigian));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Trạng thái cập nhật
                                    </td>
                                    <td>
                                        <?php
                                        echo $record->trangthaithaydoi;
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <div class="card">
            <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Dữ liệu cũ</th>
                            <th>Dữ liệu mới</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $dulieucu = json_decode($record->dulieucu, true);
                        $dulieumoi = json_decode($record->dulieumoi, true); ?>
                        <tr>
                            <td>
                                <?php
                                foreach ($dulieucu as $key => $value) {
                                    echo $key . ": " . $value . "<br>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                foreach ($dulieumoi as $key => $value) {
                                    echo $key . ": " . $value . "<br>";
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</section>