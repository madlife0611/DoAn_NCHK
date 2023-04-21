<?php
$this->fileLayout = "Layout.php";
?>
<section class="content-header">
	<div class="container">
		<div class="row">
			<div class="col-9">
				<form action="index.php?controller=request&action=update" method="post">
					<table class="table table-data table-hover">
						<thead>
							<tr>
								<th class="anh" scope="col">Ảnh</th>
								<th class="tensp" scope="col">Tên vật tư</th>
								<th class="gianhap" scope="col">Giá nhập</th>
								<th class="quantity" scope="col">Số lượng</th>
								<th class="price" scope="col">Thành tiền</th>
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
									<td><input type="number" id="qty" min="1" class="input-control" value="<?php echo $product["number"]; ?>" name="product_<?php echo $product["masp"]; ?>" required="Không thể để trống"></td>
									<td><?php echo number_format($product["gianhap"] * $product["number"]); ?>₫</td>
									<td>
										<a href="index.php?controller=request&action=delete&masp=<?php echo $product["masp"]; ?>" data-id="2479395"><i class="fa fa-trash" style="color: #f48120;"></i></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4">
									<a href="index.php" class="btn btn-hover">Trở lại trang chủ</a>
								</td>
								<td><input type="submit" class="btn btn-hover" value="Cập nhật"></td>
								<td><a href="index.php?controller=request&action=destroy" class="btn btn-hover">Xóa toàn bộ</a></td>
							</tr>
						</tfoot>
					</table>
				</form>
			</div>
			<div class="col-3" style="border: 2px solid #224099; padding: 20px; border-radius: 20px;">
				<?php if ($this->requestNumber() > 0) : ?>
					<div class="mb-3" style="color: #224099; font-weight: bold;">VUI LÒNG KIỂM TRA KỸ TRƯỚC KHI REQUEST</div>
					<div class="mb-3">Tổng tiền: <?php echo number_format($this->requestTotal()); ?>₫</div>
					<div><a href="index.php?controller=request&action=checkout" class="btn btn-hover">Xác nhận request</a></div>
				<?php else : ?>
					<div>Chưa có sản phẩm nào trong request</div>
					<div><a href="index.php" class="btn btn-hover">Trở lại trang chủ</a></div>
				<?php endif; ?>
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
							Lịch sử request
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
									<th style="width: 100px;">Ánh </th>
									<th>Tên</th>
									<th>Số lượng</th>
									<th>Ngày lập</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $rows) : ?>
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
											<?php echo date("Y-m-d", strtotime($rows->ngaynhap)); ?>
										</td>
										<td>
											<?php
											//co the goi ham tu class model o day
											$supplier = $this->getSupplier($rows->mancc);
											echo isset($supplier->tenncc) ? $supplier->tenncc : "";
											?>
										</td>
										<td class="text-center">
											<a class="btn btn-primary btn-sm" href="index.php?controller=products&action=detail&masp=<?php echo $rows->masp; ?>">
												<i class="fas fa-eye">
												</i>
												Xem chi tiết
											</a>
											<a class="btn btn-info btn-sm" href="index.php?controller=request&action=create&masp=<?php echo $rows->masp; ?>">
												<i class="fas fa-plus"></i>
												Thêm vào yêu cầu sử dụng
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