<?php
$this->fileLayout = "Layout.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h3>Yêu cầu sử dụng</h3>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
					<li class="breadcrumb-item active">Yêu cầu sử dụng </li>
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
							<h4>Lịch sử request</h4>
						</div>
						<div class="form-inline float-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default">Sắp xếp</button>
								<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu" style="">
									<a class="dropdown-item" href="index.php?controller=products&action=category&madm=<?php echo $madm; ?>&order=idtang">Theo mã
										vật tư tăng dần</a>
									<a class="dropdown-item" href="index.php?controller=products&action=category&madm=<?php echo $madm; ?>&order=idgiam">Theo mã
										vật giảm dần</a>
									<a class="dropdown-item" href="index.php?controller=products&action=category&madm=<?php echo $madm; ?>&order=ngaynhapgan">Theo
										ngày nhập gần
										dần</a>
									<a class="dropdown-item" href="index.php?controller=products&action=category&madm=<?php echo $madm; ?>&order=ngaynhapxa">Theo
										ngày nhập xa nhất
										dần</a>

								</div>
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0" style="height: 500px;">
						<table class="table table-head-fixed text-wrap">
							<thead>
								<tr>
									<th>Mã request</th>
									<th>Ngày lập</th>
									<th>Người yêu cầu</th>
									<th>Email</th>
									<th>SDT</th>
									<th>Phòng ban</th>
									<th>Trạng thái</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $rows) : ?>
									<?php
									$account = $this->modelGetAccount($rows->matk);
									$department = $this->modelGetDepartment($account->mapb);
									?>
									<tr>
										<td>
											<?php echo $rows->request_id; ?>
										</td>
										<td>
											<?php echo date("d/m/Y", strtotime($rows->ngaylap)); ?>
										</td>
										<td>
											<?php echo isset($account->hoten) ? $account->hoten : ""; ?>
										</td>
										<td>
											<?php echo isset($account->email) ? $account->email : ""; ?>
										</td>
										<td>
											<?php echo isset($account->sdt) ? $account->sdt : ""; ?>
										</td>
										<td>
											<?php echo isset($department->tenpb) ? $department->tenpb : ""; ?>
										</td>
										<td>
											<?php if ($rows->trangthai == 1) : ?>
												<p>Đã xác nhận</p>
											<?php else : ?>
												<p>Chưa xác nhận</p>
											<?php endif; ?>
										</td>
										<td class="text-center">
											<?php if ($rows->trangthai == 0) : ?>
												<a class="btn btn-primary btn-sm" href="index.php?controller=requests&action=delivery&request_id=<?php echo $rows->request_id; ?>">
												<i class="fas fa-vote-yea"></i>
													Xác nhận yêu cầu
												</a>
											<?php endif; ?>
											<a class="btn btn-primary btn-sm" href="index.php?controller=requests&action=detail&request_id=<?php echo $rows->request_id; ?>">
												<i class="fas fa-eye">
												</i>
												Xem chi tiết
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
								<?php for ($i = 1; $i <= $numPage; $i++) : ?>
									<li class="page-item"><a class="page-link" href="index.php?controller=products&action=category&madm=<?php echo $madm; ?>&p=<?php echo $i; ?>"><?php echo $i; ?></a>
									</li>
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