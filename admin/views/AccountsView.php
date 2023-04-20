<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <button type="button" class="btn btn-default"><a href="index.php?controller=accounts&action=create">Thêm tài khoản mới <i
              class="fas fa-plus"></i></a></button>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
          <li class="breadcrumb-item active">Nhân sự</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="card card-solid">
    <div class="card-header">
      <div class="card-title">
        <b>Tài khoản quản lý</b>
      </div>
    </div>
    <div class="card-body pb-0">
      <div class="row">
        <?php foreach ($data as $rows): ?>
          <?php if (isset($rows->isAdmin) && $rows->isAdmin == 1): ?>
            <!-- col -->
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Phòng ban:
                  <?php
                  //co the goi ham tu class model o day
                  $phongban = $this->getDepartment($rows->mapb);
                  echo isset($phongban->tenpb) ? $phongban->tenpb : "";
                  ?>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>
                          <?php echo $rows->hoten; ?>
                        </b></h2>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Địa chỉ:
                          <?php echo $rows->diachi; ?>
                        </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-at"></i></span> Email:
                          <?php echo $rows->email; ?>
                        </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Số điện thoại:
                          <?php echo $rows->sdt; ?>
                        </li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="../assets/image/upload/accounts/<?php echo $rows->photo; ?>" alt="user-avatar"
                        class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a class="btn btn-primary btn-sm" href="#">
                    <i class="fas fa-eye">
                    </i>
                    View
                  </a>
                  <a class="btn btn-info btn-sm"
                    href="index.php?controller=accounts&action=update&matk=<?php echo $rows->matk; ?>">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                  </a>
                </div>
              </div>
              <!-- end card -->
            </div>
          <?php endif; ?>
          <!-- end col -->
        <?php endforeach; ?>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <nav aria-label="Contacts Page Navigation">
        <ul class="pagination justify-content-center m-0">
          <?php for ($i = 1; $i <= $numPage; $i++): ?>
            <li class="page-item"><a class="page-link" href="index.php?controller=accounts&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-header">
      <div class="card-title">
        <b>Tài khoản nhân viên</b>
      </div>
    </div>
    <div class="card-body pb-0">
      <div class="row">
        <?php foreach ($data as $rows): ?>
          <?php if (isset($rows->isAdmin) && $rows->isAdmin == 0): ?>
            <!-- col -->
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Phòng ban:
                  <?php
                  //co the goi ham tu class model o day
                  $phongban = $this->getDepartment($rows->mapb);
                  echo isset($phongban->tenpb) ? $phongban->tenpb : "";
                  ?>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>
                          <?php echo $rows->hoten; ?>
                        </b></h2>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Địa chỉ:
                          <?php echo $rows->diachi; ?>
                        </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-at"></i></span> Email:
                          <?php echo $rows->email; ?>
                        </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Số điện thoại:
                          <?php echo $rows->sdt; ?>
                        </li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="../assets/image/upload/accounts/<?php echo $rows->photo; ?>" alt="user-avatar"
                        class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a class="btn btn-primary btn-sm" href="#">
                    <i class="fas fa-eye">
                    </i>
                    View
                  </a>
                  <a class="btn btn-info btn-sm"
                    href="index.php?controller=accounts&action=update&matk=<?php echo $rows->matk; ?>">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                  </a>
                  <a class="btn btn-danger btn-sm"
                    href="index.php?controller=accounts&action=delete&matk=<?php echo $rows->matk; ?>"
                    onclick="return window.confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                  </a>
                </div>
              </div>
            </div>
            <!-- end col -->
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <nav aria-label="Contacts Page Navigation">
        <ul class="pagination justify-content-center m-0">
          <?php for ($i = 1; $i <= $numPage; $i++): ?>
            <li class="page-item"><a class="page-link" href="index.php?controller=accounts&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->