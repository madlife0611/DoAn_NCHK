<?php
$this->fileLayout = "Layout.php";
?>
<section class="content-header">
	<div class="container">
		<div class="row">
			<div class="col-9">
				<div class="card-body table-responsive p-0">
					<form action="index.php?controller=request&action=update" method="post">
						<table class="table table-head-fixed text-wrap">
							<thead>
								<tr>
									<th class="anh" scope="col">Ảnh</th>
									<th class="tensp" scope="col">Tên vật tư</th>
									<th class="gianhap" scope="col">Giá nhập</th>
									<th class="" scope="col">Số lượng có</th>
									<th class="quantity" scope="col">Số lượng yêu cầu</th>
									<th scope="col">Xóa</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($_SESSION['request'] as $product) :
								?>
									<tr>
										<td>
											<img src="../assets/image/upload/products/<?php echo $product["anhsp"]; ?>" style="max-width: 100px;">
										</td>
										<td><?php echo $product["tensp"]; ?></td>
										<td><?php echo number_format($product["gianhap"]); ?>đ</td>
										<td><?php echo $product["soluong"]; ?></td>
										<td><input type="number" id="qty" min="1" class="input-control" value="<?php echo $product["number"]; ?>" name="product_<?php echo $product["masp"]; ?>" required="Không thể để trống"></td>

										<td>
											<a href="index.php?controller=request&action=delete&masp=<?php echo $product["masp"]; ?>" data-id="2479395"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4">
										<a href="index.php" class="btn btn-primary btn-sm">Trở lại trang chủ</a>
									</td>
									<td><input type="submit" class="btn btn-primary btn-sm" value="Cập nhật"></td>
									<td><a href="index.php?controller=request&action=destroy" class="btn btn-primary btn-sm">Xóa toàn bộ</a></td>
								</tr>
							</tfoot>
						</table>
					</form>
				</div>
			</div>
			<script type="text/javascript">
				function displayMessage(message) {
					alert(message);
				}
			</script>
			<div class="col-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Mã tài khoản: <?php echo $_SESSION['matk']; ?></h5>
						<p class="card-text">Email: <?php echo $_SESSION['email_tk']; ?></p>
						<p class="card-text">Phòng ban: <?php
														$department = $this->modelGetDepartment($_SESSION['mapb']);
														echo isset($department->tenpb) ? $department->tenpb : "";
														?></p>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<?php if ($this->requestNumber() > 0) : ?>
							<h5 class="card-title">VUI LÒNG KIỂM TRA KỸ TRƯỚC KHI REQUEST</h5>
							<p class="card-text">Tổng tiền: <?php echo number_format($this->requestTotal()); ?>₫</p>
							<a href="index.php?controller=request&action=checkout" class="btn btn-primary btn-sm">Xác nhận request</a>
						<?php else : ?>
							<h5 class="card-title">CHƯA CÓ SẢN PHẨM NÀO TRONG REQUEST</h5>
							<a href="index.php" class="btn btn-primary btn-sm">Trở lại trang chủ</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="content list-products">
	<div class="container">
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
									<th>Tổng tiền</th>
									<th>Trạng thái</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $rows) : ?>
									<tr>
										<td>
											<?php echo $rows->request_id; ?>
										</td>
										<td>
											<?php echo date("d/m/Y", strtotime($rows->ngaylap)); ?>
										</td>
										<td>
											<?php echo number_format($rows->tongtien); ?> đ
										</td>
										<td>
											<?php if ($rows->trangthai == 1) : ?>
												<p>Đã xác nhận</p>
											<?php elseif ($rows->trangthai == 2) : ?>
												<p>Đã hủy</p>
											<?php else : ?>
												<p>Chưa xác nhận</p>
											<?php endif; ?>
										</td>
										<td class="text-center">
											<?php if ($rows->trangthai == 0) : ?>
												<a href="index.php?controller=request&action=delete_request&request_id=<?php echo $rows->request_id; ?>" class="btn btn-danger btn-sm" onclick="return window.confirm('Bạn có chắc chắn hủy yêu cầu này?');"><i class="fas fa-trash"></i>Hủy yêu cầu</a>
											<?php endif; ?>
											<a class="btn btn-primary btn-sm" href="index.php?controller=request&action=detail&request_id=<?php echo $rows->request_id; ?>">
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
									<li class="page-item"><a class="page-link" href="index.php?controller=request&p=<?php echo $i; ?>"><?php echo $i; ?></a>
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