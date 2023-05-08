<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="../assets/image/logo-612x612.png" alt="BKAT Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">BKAT Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../assets/image/upload/accounts/<?php echo $_SESSION["photo_admin"]; ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION["hoten_admin"]; ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
          <a href="index.php" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?controller=products" class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Vật tư
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?controller=categories" class="nav-link">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Danh mục vật tư
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?controller=suppliers" class="nav-link">
            <i class="nav-icon fas fa-building"></i>
            <p>
              Nhà cung cấp
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?controller=requests" class="nav-link">
            <i class="nav-icon far fa-clipboard"></i>
            <p>
              Yêu cầu sử dụng
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?controller=maintenances" class="nav-link">
            <i class="nav-icon fas fa-tools"></i>
            <p>
              Danh sách bảo trì
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?controller=departments" class="nav-link">
            <i class=" nav-icon fas fa-house-user"></i>
            <p>
              Phòng ban
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?controller=accounts" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Nhân sự
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?controller=changelog" class="nav-link">
            <i class="nav-icon fas fa-history"></i>
            <p>
              Lịch sử thay đổi
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <script>
      // Lấy tất cả các thẻ <a> trong thanh navbar
      const navLinks = document.querySelectorAll('.nav-link');

      // Duyệt qua các thẻ <a> và đặt lắng nghe sự kiện click
      navLinks.forEach((link) => {
        link.addEventListener('click', function() {
          // Loại bỏ class 'active' từ tất cả các thẻ <a>
          navLinks.forEach((link) => {
            link.classList.remove('active');
          });
          // Truyền class 'active' cho thẻ được chọn
          this.classList.add('active');
        });
      });
    </script>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>