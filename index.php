<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/lte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/lte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="assets/lte/index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Lấy thông tin đăng nhập từ form HTML
			$email = $_POST['email'];
			$password = $_POST['password'];

      $password = md5($password);

			try {
				$dbh = new PDO("mysql:host=localhost;dbname=mvc_qlvattu","root","");

				// Kiểm tra thông tin đăng nhập trong CSDL
				$stmt = $dbh->prepare('SELECT * FROM accounts WHERE email = ? AND password = ?');
				$stmt->execute([$email, $password]);

				$user = $stmt->fetch();

				if ($user) {
					// Nếu thông tin đăng nhập chính xác, chuyển hướng đến trang dành cho người dùng hoặc quản trị viên
					if ($user['isAdmin'] == 1) {
						header('Location: admin/index.php');
					} else {
						header('Location: users/index.php');
					}
				} else {
					// Nếu thông tin đăng nhập không chính xác, hiển thị thông báo lỗi
					echo '<p style="color: red;">Email hoặc mật khẩu không chính xác</p>';
				}

				// Đóng kết nối CSDL
				$dbh = null;
			} catch (PDOException $e) {
				// Hiển thị thông báo lỗi nếu có lỗi xảy ra
				echo "Lỗi kết nối CSDL: " . $e->getMessage();
			}
		}
	?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/lte/dist/js/adminlte.min.js"></script>
</body>
</html>
