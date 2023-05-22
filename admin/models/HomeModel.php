<?php
trait HomeModel
{
	//hàm lấy dữ liệu cho stacked bar chart
	public function getChartDataForStackedBarChart()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = "SELECT categories.tendm, SUM(products.soluong) AS tong_soluong, 
		SUM(CASE WHEN products.trangthai = 0 THEN products.soluong ELSE 0 END) AS soluong_trangthai_0,
		SUM(CASE WHEN requestdetails.trangthaivattu = 1 THEN requestdetails.soluongyc ELSE 0 END) AS soluong_trangthai_1,
		SUM(CASE WHEN products.trangthai = 2 THEN products.soluong ELSE 0 END) AS soluong_trangthai_2,
		SUM(CASE WHEN requestdetails.trangthaivattu = 3 THEN requestdetails.soluongyc ELSE 0 END) AS soluong_trangthai_3
		FROM categories
		INNER JOIN products ON categories.madm = products.madm
		INNER JOIN requestdetails ON requestdetails.masp = products.masp
		INNER JOIN requests ON requests.request_id = requestdetails.request_id
		GROUP BY categories.tendm";
		$stmt = $db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	//hàm lấy dữ liệu cho stacked bar chart
	public function getChartDataForSuppliers()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = "SELECT suppliers.tenncc, SUM(products.soluong) AS tong_soluong, 
		SUM(CASE WHEN products.trangthai = 0 THEN products.soluong ELSE 0 END) AS soluong_trangthai_0,
		SUM(CASE WHEN requestdetails.trangthaivattu = 1 THEN requestdetails.soluongyc ELSE 0 END) AS soluong_trangthai_1,
		SUM(CASE WHEN products.trangthai = 2 THEN products.soluong ELSE 0 END) AS soluong_trangthai_2,
		SUM(CASE WHEN requestdetails.trangthaivattu = 3 THEN requestdetails.soluongyc ELSE 0 END) AS soluong_trangthai_3
		FROM suppliers
		INNER JOIN products ON suppliers.mancc = products.mancc
		INNER JOIN requestdetails ON requestdetails.masp = products.masp
		INNER JOIN requests ON requests.request_id = requestdetails.request_id
		GROUP BY suppliers.tenncc";
		$stmt = $db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	//hàm lấy dữ liệu cho Donut chart
	public function getChartDataForDonutChart()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = "SELECT SUM(products.soluong) AS tong_soluong, 
SUM(CASE WHEN products.trangthai = 0 THEN products.soluong ELSE 0 END) AS soluong_trangthai_0,
		SUM(CASE WHEN requestdetails.trangthaivattu = 1 THEN requestdetails.soluongyc ELSE 0 END) AS soluong_trangthai_1,
		SUM(CASE WHEN products.trangthai = 2 THEN products.soluong ELSE 0 END) AS soluong_trangthai_2,
		SUM(CASE WHEN requestdetails.trangthaivattu = 3 THEN requestdetails.soluongyc ELSE 0 END) AS soluong_trangthai_3
		FROM products
		INNER JOIN requestdetails ON requestdetails.masp = products.masp
		INNER JOIN requests ON requests.request_id = requestdetails.request_id";
		$stmt = $db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	//hàm lấy dữ liệu cho thống kê tài chính
	public function getChartDataForReportChart()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = "SELECT SUM(products.soluong*products.gianhap) AS tongtien_soluong, 
		SUM(CASE WHEN requestdetails.trangthaivattu = 4 THEN requestdetails.soluongyc * requestdetails.gianhap ELSE 0 END) AS tongtien_requests_type1,
		SUM(CASE WHEN maintenances.trangthai = 1 THEN maintenances.tongchiphi ELSE 0 END) AS tongchiphi_baotri,
		SUM(CASE WHEN requestdetails.trangthaivattu = 3 THEN requestdetails.soluongyc * requestdetails.gianhap ELSE 0 END) AS tongtien_loihong
		FROM products
		INNER JOIN requestdetails ON requestdetails.masp = products.masp
		INNER JOIN requests ON requests.request_id = requestdetails.request_id
		INNER JOIN maintenance_details ON maintenance_details.masp = products.masp
		INNER JOIN maintenances ON maintenances.mabt = maintenance_details.mabt";
		$stmt = $db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	//lấy tổng yêu cầu chưa xác nhận
	public function modelTotalUnconfirmedRequest()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from requests where trangthai = 0");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//lấy tổng số vật tư 
	public function modelTotalProducts()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select sum(soluong) from products");
		return $query->fetchColumn();
	}
	//lấy tổng số vật tư sắp đến hạn bảo trì trong 14 ngày
	public function modelTotalMaintenanceProducts()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select sum(soluong) from products where DATEDIFF(hanbaotri,now())<14");
		return $query->fetchColumn();
	}
	//lấy tổng số thay đổi đã thực hiện trong tuần qua
	public function modelTotalChangeLogOn7Days()
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from changelog where DATEDIFF(now(),thoigian)<7");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
}
