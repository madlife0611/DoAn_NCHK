<?php
//load file MainLayout.php vao day
$this->fileLayout = "Layout.php";
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo $TotalProducts = $this->modelTotalProducts(); ?></h3>
            <p>Tổng số vật tư</p>
          </div>
          <div class="icon">
            <i class="fas fa-boxes"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo $TotalMaintenanceProducts = $this->modelTotalMaintenanceProducts();
                ?></h3>

            <p>Vật tư đến hạn bảo trì trong 2 tuần tới</p>
          </div>
          <div class="icon">
            <i class="fas fa-wrench"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo $TotalChangeLogOn7Days = $this->modelTotalChangeLogOn7Days();
                ?></h3>

            <p>Cập nhật trong tuần qua</p>
          </div>
          <div class="icon">
            <i class="fas fa-history"></i>
          </div>
          <a href="index.php?controller=changelog" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo $TotalUnconfirmedRequest = $this->modelTotalUnconfirmedRequest();
                ?></h3>

            <p>Yêu cầu chưa xác nhận</p>
          </div>
          <div class="icon">
            <i class="far fa-clipboard"></i>
          </div>
          <a href="index.php?controller=requests" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-8 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              Thống kê vật tư từng danh mục
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Stackes bar chart - products -->
              <div class="chart tab-pane active" style="position: relative; height: 300px;">
                <canvas id="myChart" style="min-height: 250px; height: 300px; width:100%; max-height: 600px;"></canvas>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
        <?php
        $chart = $this->getChartDataForStackedBarChart();
        $data = array();
        foreach ($chart as $row) {
          $data[] = array(
            'label' => $row['tendm'],
            'data' => array(
              $row['tong_soluong'],
              $row['soluong_trangthai_0'],
              $row['soluong_trangthai_1'],
              $row['soluong_trangthai_2'],
              $row['soluong_trangthai_3']
            )
          );
        }

        $json_data = json_encode($data);
        ?>
        <script>
          var data = <?php echo $json_data; ?>;

          var options = {
            title: {
              display: true,
              text: 'Thống kê sản phẩm theo danh mục'
            },
            scales: {
              xAxes: [{
                stacked: true
              }],
              yAxes: [{
                stacked: true,
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          };

          var ctx = document.getElementById('myChart').getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ['Tổng số lượng sản phẩm', 'Tự do', 'Đang sử dụng', 'Đang bảo trì', 'Lỗi/Hỏng'],
              datasets: data
            },
            options: options
          });
        </script>
        <script>
          var data = <?php echo $json_data; ?>;

          var categories = [];
          var tong_soluong = [];
          var trangthai_0 = [];
          var trangthai_1 = [];
          var trangthai_2 = [];
          var trangthai_3 = [];

          for (var i in data) {
            categories.push(data[i].tendm);
            tong_soluong.push(data[i].tong_soluong);
            trangthai_0.push(data[i].soluong_trangthai_0);
            trangthai_1.push(data[i].soluong_trangthai_1);
            trangthai_2.push(data[i].soluong_trangthai_2);
            trangthai_3.push(data[i].soluong_trangthai_3);
          }
          var chartdata = {
            labels: categories,
            datasets: [{
                label: 'Tự do',
                data: soluong_trangthai_0,
                backgroundColor: '#f44336',
                borderWidth: 1
              },
              {
                label: 'Đang sử dụng',
                data: soluong_trangthai_1,
                backgroundColor: '#2196f3',
                borderWidth: 1
              },
              {
                label: 'Đang bảo trì',
                data: soluong_trangthai_2,
                backgroundColor: '#4caf50',
                borderWidth: 1
              },
              {
                label: 'Lỗi/Hỏng',
                data: soluong_trangthai_3,
                backgroundColor: '#ffeb3b',
                borderWidth: 1
              },
              {
                label: 'Tổng số lượng',
                data: tong_soluong,
                backgroundColor: '#9e9e9e',
                borderWidth: 1
              }
            ]
          };

          var options = {
            responsive: true,
            scales: {
              xAxes: [{
                stacked: true
              }],
              yAxes: [{
                stacked: true,
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          };

          var ctx = document.getElementById('myChart').getContext('2d');

          var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartdata,
            options: options
          });
        </script>
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              Thống kê vật tư theo nhà cung cấp
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Stackes bar chart - products -->
              <div class="chart tab-pane active" style="position: relative; height: 300px;">
                <canvas id="myChart_Suppliers" style="min-height: 250px; height: 300px; width:100%; max-height: 600px;"></canvas>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
        <?php
        $chart = $this->getChartDataForSuppliers();
        $data = array();
        foreach ($chart as $row) {
          $data[] = array(
            'label' => $row['tenncc'],
            'data' => array(
              $row['tong_soluong'],
              $row['soluong_trangthai_0'],
              $row['soluong_trangthai_1'],
              $row['soluong_trangthai_2'],
              $row['soluong_trangthai_3']
            )
          );
        }

        $json_data = json_encode($data);
        ?>
        <script>
          var data = <?php echo $json_data; ?>;

          var options = {
            title: {
              display: true,
              text: 'Thống kê sản phẩm theo nhà cung cấp'
            },
            scales: {
              xAxes: [{
                stacked: true
              }],
              yAxes: [{
                stacked: true,
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          };

          var ctx = document.getElementById('myChart_Suppliers').getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ['Tổng số lượng sản phẩm', 'Tự do', 'Đang sử dụng', 'Đang bảo trì', 'Lỗi/Hỏng'],
              datasets: data
            },
            options: options
          });
        </script>
        <script>
          var data = <?php echo $json_data; ?>;

          var suppliers = [];
          var tong_soluong = [];
          var trangthai_0 = [];
          var trangthai_1 = [];
          var trangthai_2 = [];
          var trangthai_3 = [];

          for (var i in data) {
            suppliers.push(data[i].tenncc);
            tong_soluong.push(data[i].tong_soluong);
            trangthai_0.push(data[i].soluong_trangthai_0);
            trangthai_1.push(data[i].soluong_trangthai_1);
            trangthai_2.push(data[i].soluong_trangthai_2);
            trangthai_3.push(data[i].soluong_trangthai_3);
          }
          var chartdata = {
            labels: suppliers,
            datasets: [{
                label: 'Tự do',
                data: soluong_trangthai_0,
                backgroundColor: '#f44336',
                borderWidth: 1
              },
              {
                label: 'Đang sử dụng',
                data: soluong_trangthai_1,
                backgroundColor: '#2196f3',
                borderWidth: 1
              },
              {
                label: 'Đang bảo trì',
                data: soluong_trangthai_2,
                backgroundColor: '#4caf50',
                borderWidth: 1
              },
              {
                label: 'Lỗi/Hỏng',
                data: soluong_trangthai_3,
                backgroundColor: '#ffeb3b',
                borderWidth: 1
              },
              {
                label: 'Tổng số lượng',
                data: tong_soluong,
                backgroundColor: '#9e9e9e',
                borderWidth: 1
              }
            ]
          };

          var options = {
            responsive: true,
            scales: {
              xAxes: [{
                stacked: true
              }],
              yAxes: [{
                stacked: true,
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          };

          var ctx = document.getElementById('myChart_Suppliers').getContext('2d');

          var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartdata,
            options: options
          });
        </script>
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-4 connectedSortable">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              Thống kê vật tư theo trạng thái
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Stackes bar chart - products -->
              <div class="chart tab-pane active" style="position: relative; height: 300px;">
                <canvas id="donut-chart" style="min-height: 250px; height: 300px; width:100%; max-height: 600px;"></canvas>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
        <?php $donut = $this->getChartDataForDonutChart();
        ?>
        <script>
          // Lấy dữ liệu từ hàm getChartDataForDonutChart()
          var data = <?php echo json_encode($donut); ?>;

          // Tạo mảng các màu cho các phần tử trong biểu đồ donut
          var colors = [
            '#FF6384',
            '#36A2EB',
            '#FFCE56',
            '#4BC0C0',
            '#9966FF',
            '#AC64AD',
            '#D6BCC0'
          ];

          // Tạo đối tượng biểu đồ donut
          var ctx = document.getElementById('donut-chart').getContext('2d');
          var chart = new Chart(ctx, {
            // Loại biểu đồ
            type: 'doughnut',

            // Dữ liệu cho biểu đồ
            data: {
              labels: ['Tự do', 'Đang sử dụng', 'Đang bảo trì', 'Lỗi/Hỏng'],
              datasets: [{
                data: [
                  data[0]['soluong_trangthai_0'],
                  data[0]['soluong_trangthai_1'],
                  data[0]['soluong_trangthai_2'],
                  data[0]['soluong_trangthai_3']
                ],
                backgroundColor: colors,
                borderWidth: 0
              }]
            },

            // Tùy chọn cho biểu đồ
            options: {
              responsive: true,
              maintainAspectRatio: false,
              legend: {
                display: true,
                position: 'bottom'
              },
              title: {
                display: true,
                text: 'Biểu đồ Donut'
              }
            }
          });
        </script>



      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->