<?php 
	$this->fileLayout = "Layout.php";
 ?>
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nhân sự</h1>
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

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
          <?php foreach($data as $rows): ?>
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
                      <h2 class="lead"><b><?php echo $rows->hoten; ?></b></h2>
                      <p class="text-muted text-sm">
                        <b>Chức vụ: </b> 
                        <?php if(isset($rows->isAdmin) && $rows->isAdmin == 1): ?>
                            Quản lý 
                        <?php endif; ?>
                        <?php if(isset($rows->isAdmin) && $rows->isAdmin == 0): ?>
                            Nhân viên
                        <?php endif; ?> 
                      </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Địa chỉ: <?php echo $rows->diachi; ?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-at"></i></span> Email: <?php echo $rows->email; ?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Số điện thoại: <?php echo $rows->sdt; ?></li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="../assets/image/upload/accounts/<?php echo $rows->anhdaidien; ?>" alt="user-avatar" class="img-circle img-fluid">
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
            </div>
            <!-- end col -->
            <?php endforeach; ?>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
              <?php for($i = 1; $i <= $numPage; $i++): ?>
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