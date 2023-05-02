<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
    <a href="../../index3.html" class="navbar-brand">
      <img src="../assets/image/logo-612x612.png" alt="BKAT Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
      <span class="brand-text font-weight-light">BKAT</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

      <?php
        $matk = $_SESSION["matk"];
        $db = Connection::getInstance();
        $query = $db->query("select * from categories order by madm asc");
        $categories = $query->fetchAll();
        $query_d = $db->query("select * from departments where mapb = (select mapb from accounts where matk = $matk)");
        $pb = $query_d->fetch();
        ?>
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="index.php" class="nav-link">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a href="index.php?controller=department" class="nav-link">Phòng ban: <?php echo $pb->tenpb; ?></a>
        </li>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Danh mục vật tư</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <?php foreach ($categories as $rows): ?>
              <li><a href="index.php?controller=products&action=category&madm=<?php echo $rows->madm; ?>"
                  class="dropdown-item"><b>
                    <?php echo $rows->tendm; ?>:
                  </b>
                  <?php echo $rows->mota; ?>
                </a></li>
            <?php endforeach; ?>
          </ul>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-0 ml-md-3">
        <div class="input-group input-group-sm" style="">
          <input class="form-control form-control-navbar" autocomplete="off" type="search" placeholder="Tìm kiếm vật tư" id="key" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search" id="btnSearch"></i>
            </button>
          </div>
        </div>
        <div class="smart-search">
            <ul>
              <li><a href="#">Sản phẩm 1</a></li>
              <li><a href="#">Sản phẩm 1</a></li>
              <li><a href="#">Sản phẩm 1</a></li>
            </ul>
          </div>
      </form>


    <ul class="navbar-nav ml-auto">

    <!-- Messages Dropdown Menu -->
      <?php
      $ProductNumberRequest = 0;
      if (isset($_SESSION['request'])) foreach ($_SESSION['request'] as $product)
          $ProductNumberRequest++;
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-cart-plus"></i>
          <span class="badge badge-danger navbar-badge">
            <?php echo $ProductNumberRequest; ?>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php if (isset($_SESSION['request'])): ?>
            <?php foreach ($_SESSION['request'] as $product): ?>
              <a href="#" class="dropdown-item">
                <!-- product Start -->
                <div class="media">
                  <img src="../assets/image/upload/products/<?php echo $product["anhsp"]; ?>" alt="product"
                    class="img-size-50 mr-3 ">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      <?php echo $product["tensp"]; ?>

                    </h3>
                    <p class="text-sm">
                      <?php echo $product["mota"]; ?>
                    </p>

                  </div>
                </div>
                <!-- product End -->
              </a>
              <div class="dropdown-divider"></div>
            <?php endforeach; ?>
          <?php endif; ?>
          <a href="index.php?controller=request" class="dropdown-item dropdown-footer">Chi tiết yêu cầu</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-user mr-2"></i></i>
            <?php echo $_SESSION["hoten"]; ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i>
            <?php echo $_SESSION["email_tk"]; ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> LogOut
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Cập nhật thông tin cá nhân</a>
        </div>
      </li>
  </ul>
  </div>
</nav>
<!-- /.navbar -->
<style type="text/css">
  .smart-search {
    position: absolute;
    border: 1px solid #000;
    border-radius: 20px 0 0 0;
    margin-top: 330px;
    width: 330px;
    padding-left: 10px;
    background: white;
    height: 300px;
    overflow: scroll;
    z-index: 2;
    display: none;
  }

  .smart-search ul {
    padding: 0px;
    margin: 0px;
    list-style: none;
  }

  .smart-search a {
    text-decoration: none;
    color: black;
  }
</style>
<script type="text/javascript">
  $(document).ready(function() {
    //bat su kien click cua id=btnSearch
    $("#btnSearch").click(function() {
      var key = $("#key").val();
      //di chuyen den url tim kiem
      location.href = "index.php?controller=search&action=name&key=" + key;
    });
    //---
    $(".form-control-navbar").keyup(function() {
      var strKey = $("#key").val();
      if (strKey.trim() == "")
        $(".smart-search").attr("style", "display:none");
      else {
        $(".smart-search").attr("style", "display:block");
        //---
        //su dung ajax de lay du lieu
        $.get("index.php?controller=search&action=ajaxSearch&key=" + strKey, function(data) {
          //clear cac the li ben trong the ul
          $(".smart-search ul").empty();
          //them du lieu vua lay duoc bang ajax vao the ul
          $(".smart-search ul").append(data);
        });
        //---
      }
    });
    //---
  });
</script>