<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Danh sách vật tư</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
          <li class="breadcrumb-item active">Vật tư</li>
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
                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown"
                  aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu" style="">
                  <a class="dropdown-item" href="#">Theo ngày nhập gần dần</a>
                  <a class="dropdown-item" href="#">Theo ngày nhập xa nhất dần</a>
                  <a class="dropdown-item" href="#">Theo ngày bảo trì tăng dần</a>
                </div>
              </div>
            </div>
            <div class="form-inline float-right">
              <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-default">
                    <i class="fas fa-fw fa-search"></i>
                  </button>
                </div>
              </div>
              <div class="sidebar-search-results">
                <div class="list-group"><a href="#" class="list-group-item">
                    <div class="search-title"><strong class="text-light"></strong>N<strong
                        class="text-light"></strong>o<strong class="text-light"></strong> <strong
                        class="text-light"></strong>e<strong class="text-light"></strong>l<strong
                        class="text-light"></strong>e<strong class="text-light"></strong>m<strong
                        class="text-light"></strong>e<strong class="text-light"></strong>n<strong
                        class="text-light"></strong>t<strong class="text-light"></strong> <strong
                        class="text-light"></strong>f<strong class="text-light"></strong>o<strong
                        class="text-light"></strong>u<strong class="text-light"></strong>n<strong
                        class="text-light"></strong>d<strong class="text-light"></strong>!<strong
                        class="text-light"></strong></div>
                    <div class="search-path"></div>
                  </a></div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th style="width: 100px;">Ảnh</th>
                  <th>Tên</th>
                  <th>Mô tả</th>
                  <th>Số lượng</th>
                  <th>Giá nhập</th>
                  <th>Ngày nhập</th>
                  <th>Trạng thái</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $rows): ?>
                  <tr>
                    <td>
                      <?php echo $rows->masp; ?>
                    </td>
                    <td><img src="../assets/image/upload/products/<?php echo $rows->anhsp; ?>" alt="product-img" class="img-product"></td>
                    <td>
                      <?php echo $rows->tensp; ?>
                    </td>
                    <td>
                      <?php echo $rows->mota; ?>
                    </td>
                    <td>
                      <?php echo $rows->soluong; ?>
                    </td>
                    <td>
                      <?php echo number_format($rows->gianhap, 0, '.', '.'); ?> vnđ
                    </td>
                    <td>
                      <?php echo $rows->ngaynhap; ?>
                    </td>
                    <td>
                      <?php echo $rows->trangthai; ?>
                    </td>
                    <td class="text-right">
                      <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        View
                      </a>
                      <a class="btn btn-info btn-sm" href="#">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                      </a>
                      <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
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
                      href="index.php?controller=products&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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