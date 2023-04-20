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
                <a class="dropdown-item" href="index.php?controller=products&order=idtang">Theo mã vật tư dần</a>
                  <a class="dropdown-item" href="index.php?controller=products&order=idgiam">Theo mã vật tư dần</a>
                  <a class="dropdown-item" href="index.php?controller=products&order=ngaynhapgan">Theo ngày nhập gần
                    dần</a>
                  <a class="dropdown-item" href="index.php?controller=products&order=ngaynhapxa">Theo ngày nhập xa nhất
                    dần</a>
                  <a class="dropdown-item" href="index.php?controller=products&order=thoigiandenhanbaotritang">Theo thời
                    gian ngày bảo trì gần nhất</a>
                  <a class="dropdown-item" href="index.php?controller=products&order=thoigiandenhanbaotrigiam">Theo thời
                    gian ngày bảo trì xa nhất</a>
                    <a class="dropdown-item" href="index.php?controller=products&order=trangthai_tudo">Trạng thái tự do</a>
                    <a class="dropdown-item" href="index.php?controller=products&order=trangthai_dangsudung">Trạng thái đang sử dụng</a>
                    <a class="dropdown-item" href="index.php?controller=products&order=trangthai_dangbaotri">Trạng thái đang bảo trì</a>
                    <a class="dropdown-item" href="index.php?controller=products&order=trangthai_hong">Trạng thái hỏng</a>
                </div>
              </div>
            </div>
            <div class="form-inline float-right">
              <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search"
                  id="key">
                <div class="input-group-append">
                  <button class="btn btn-default" id="btnSearchForAdmin">
                    <i class="fas fa-fw fa-search"></i>
                  </button>
                </div>
              </div>
              <div class="sidebar-search-results">
                <div class="list-group">
                  <a href="#" class="list-group-item">
                    <ul class="search-title">
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
            <table class="table table-head-fixed text-wrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th style="width: 100px;">Ảnh</th>
                  <th>Tên</th>
                  <th>Mô tả</th>
                  <th>Số lượng</th>
                  <th>Ngày nhập</th>
                  <th>Ngày bảo trì</th>
                  <th>Trạng thái</th>
                  <th>Control</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $rows): ?>
                  <tr>
                    <td>
                      <?php echo $rows->masp; ?>
                    </td>
                    <td><img src="../assets/image/upload/products/<?php echo $rows->anhsp; ?>" alt="product-img"
                        class="img-product"></td>
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
                      <?php echo date("Y-m-d", strtotime($rows->ngaynhap)); ?>
                    </td>
                    <td>
                      <?php echo $rows->hanbaotri; ?>
                    </td>
                    <td>
                      <?php if (isset($rows->trangthai) && $rows->trangthai == 0): ?>
                        Tự do
                      <?php endif; ?>
                      <?php if (isset($rows->trangthai) && $rows->trangthai == 1): ?>
                        Đang được sử dụng
                      <?php endif; ?>
                      <?php if (isset($rows->trangthai) && $rows->trangthai == 2): ?>
                        Đang bảo trì
                      <?php endif; ?>
                      <?php if (isset($rows->trangthai) && $rows->trangthai == 3): ?>
                        Hỏng
                      <?php endif; ?>
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
<script type="text/javascript">
  //tinh nang nay phai dung ket hop voi jquery -> phai load thu vien jquery
  $(document).ready(function () {
    //bat su kien click cua id=btnSearch
    $("#btnSearchForAdmin").click(function () {
      var key = $("#key").val();
      //di chuyen den url tim kiem
      location.href = "index.php?controller=search&action=name&key=" + key;
    });
    //---
    $(".input-control").keyup(function () {
      var strKey = $("#key").val();
      if (strKey.trim() == "")
        $(".sidebar-search-results").attr("style", "display:none");
      else {
        $(".sidebar-search-results").attr("style", "display:block");
        //---
        //su dung ajax de lay du lieu
        $.get("index.php?controller=search&action=ajaxSearch&key=" + strKey, function (data) {
          //clear cac the li ben trong the ul
          $(".sidebar-search-results ul").empty();
          //them du lieu vua lay duoc bang ajax vao the ul
          $(".sidebar-search-results ul").append(data);
        });
        //---
      }
    });
    //---
  });
</script>