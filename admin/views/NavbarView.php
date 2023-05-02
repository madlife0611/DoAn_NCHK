<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar position-relative" autocomplete="off" type="search" placeholder="Tìm kiếm vật tư" id="key" aria-label="Search">
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
      </div>
    </li>
    <?php
      $ProductNumberMaintenance = 0;
      if (isset($_SESSION['maintenance'])) foreach ($_SESSION['maintenance'] as $product)
          $ProductNumberMaintenance++;
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-tools"></i>
          <span class="badge badge-danger navbar-badge">
            <?php echo $ProductNumberMaintenance; ?>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php if (isset($_SESSION['maintenance'])): ?>
            <?php foreach ($_SESSION['maintenance'] as $product): ?>
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
          <a href="index.php?controller=maintenances" class="dropdown-item dropdown-footer">Chi tiết bảo trì</a>
        </div>
      </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
<style type="text/css">
  .smart-search {
    position: absolute;
    border: 1px solid #000;
    border-radius: 20px 0 0 0;
    margin-top: 330px;
    width: 500px;
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