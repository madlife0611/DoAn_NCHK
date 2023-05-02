<?php 
	trait HomeModel{
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
		$matk = $_SESSION["matk"];
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from requests where trangthai = 1 and matk = $matk");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//lấy tổng số vật tư 
	public function modelTotalProducts()
	{
		$matk = $_SESSION["matk"];
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$stmt = $conn->prepare("SELECT SUM(soluong) FROM requestdetails WHERE request_id IN (SELECT request_id FROM requests WHERE matk = ?)");
		$stmt->bindValue(1, $matk, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}
	//lấy tổng số vật tư sắp đến hạn bảo trì trong 14 ngày
	public function modelTotalType3Products()
	{
		$matk = $_SESSION["matk"];
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$stmt = $conn->prepare("SELECT SUM(soluong) FROM requestdetails WHERE masp IN (
  SELECT masp 
  FROM products 
  WHERE loaisp = 3) AND request_id IN (SELECT request_id FROM requests WHERE matk = ?) ") ;
		$stmt->bindValue(1, $matk, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}
	//lấy tổng số thay đổi đã thực hiện trong tuần qua
	public function modelTotalRequestsOn7Days()
	{
		$matk = $_SESSION["matk"];
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$stmt = $conn->prepare("select * from requests where DATEDIFF(now(),ngaylap)<7 and matk = ?");
		//tra ve so luong ban ghi
		$stmt->bindValue(1, $matk, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->rowCount();
	}	
	}
 ?>