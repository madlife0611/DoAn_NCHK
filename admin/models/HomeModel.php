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
		SUM(CASE WHEN products.trangthai = 1 THEN products.soluong ELSE 0 END) AS soluong_trangthai_1,
		SUM(CASE WHEN products.trangthai = 2 THEN products.soluong ELSE 0 END) AS soluong_trangthai_2,
		SUM(CASE WHEN products.trangthai = 3 THEN products.soluong ELSE 0 END) AS soluong_trangthai_3
		FROM categories
		INNER JOIN products ON categories.madm = products.madm
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
		SUM(CASE WHEN products.trangthai = 1 THEN products.soluong ELSE 0 END) AS soluong_trangthai_1,
		SUM(CASE WHEN products.trangthai = 2 THEN products.soluong ELSE 0 END) AS soluong_trangthai_2,
		SUM(CASE WHEN products.trangthai = 3 THEN products.soluong ELSE 0 END) AS soluong_trangthai_3
		FROM suppliers
		INNER JOIN products ON suppliers.mancc = products.mancc
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
		SUM(CASE WHEN products.trangthai = 1 THEN products.soluong ELSE 0 END) AS soluong_trangthai_1,
		SUM(CASE WHEN products.trangthai = 2 THEN products.soluong ELSE 0 END) AS soluong_trangthai_2,
		SUM(CASE WHEN products.trangthai = 3 THEN products.soluong ELSE 0 END) AS soluong_trangthai_3
		FROM products";
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
		$query = $conn->query("select * from requests where trangthai = 1");
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
