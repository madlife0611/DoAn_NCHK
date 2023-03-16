<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- add css chung-->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">

    <!-- add css cho phan nhan vien -->
    <link rel="stylesheet" href="../assets/user/styles.css">
    <!-- add js chung -->
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/jquery-3.6.3.min.js"></script>
</head>
<body>
    <div class="cover"></div>
    <div class="wrapper">
        <!-- header -->
        <div class="header">

        </div>
        <!-- end header -->
        <!-- Main content -->
        <div class="main-content">
            <?php echo $this->view; ?>
        </div>
        <!-- end Main content -->
        <!-- Footer -->
        <footer class="footer">

        </footer>
        <!-- end Footer -->
    </div>
</body>
</html>