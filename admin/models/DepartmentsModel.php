<?php
trait DepartmentsModel
{
	//lay ve danh sach cac ban ghi
	public function modelRead($recordPerPage)
	{
		//lay bien page truyen tu url
		$page = isset($_GET["p"]) && $_GET["p"] > 0 ? ($_GET["p"] - 1) : 0;
		//lay tu ban ghi nao
		$from = $page * $recordPerPage;
		//---
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from departments order by mapb asc limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	//tinh tong cac ban ghi
	public function modelTotalRecord()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from departments");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//lay mot ban ghi tuong ung voi mapb truyen vao
	public function modelGetRecord()
	{
		$mapb = isset($_GET["mapb"]) && $_GET["mapb"] > 0 ? $_GET["mapb"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//chuan bi truy van
		$query = $db->prepare("select * from departments where mapb=:var_mapb");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_mapb" => $mapb]);
		//tra ve mot ban ghi
		return $query->fetch();
	}
	//xem sản phẩm theo từng phòng ban
	public function modelReadDepartments($recordPerPage)
	{
		$mapb = isset($_GET["mapb"]) ? $_GET["mapb"] : 0;
		//lay bien page truyen tu url
		$page = isset($_GET["p"]) && $_GET["p"] > 0 ? ($_GET["p"] - 1) : 0;
		//lay tu ban ghi nao
		$from = $page * $recordPerPage;
		//---
		
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from requestdetails where request_id in (select request_id from requests where mapb = $mapb) limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	public function modelTotalRecordDepartment(){
		$mapb =isset($_GET["mapb"]) ? $_GET["mapb"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from requestdetails where request_id in (select request_id from requests where mapb = $mapb)");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	public function modelUpdate()
	{
		$mapb = isset($_GET["mapb"]) && $_GET["mapb"] > 0 ? $_GET["mapb"] : 0;
		$tenpb = $_POST["tenpb"];
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		// Lưu thông tin cũ
		$query_change = $db->prepare("SELECT * FROM departments WHERE mapb = :var_mapb");
		$query_change->execute(["var_mapb" => $mapb]);
		$dulieucu = $query_change->fetch();
		// Lấy dữ liệu cập nhật vào bảng changelog
		$tenbang = "departments";
		$dulieumoi = array(
			'mapb' => $mapb,
			'tenpb' => $tenpb
		);
		$matk_admin = $_SESSION['matk_admin'];
		$trangthaithaydoi = "update";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
		//chuan bi truy van
		$query = $db->prepare("update departments set tenpb = :var_tenpb where mapb=:var_mapb");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_mapb" => $mapb, "var_tenpb" => $tenpb]);
	}
	public function modelCreate()
	{
		$tenpb = $_POST["tenpb"];
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//chuan bi truy van
		$query = $db->prepare("insert into departments set tenpb = :var_tenpb");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_tenpb" => $tenpb]);
		// Ghi vào bảng changelog
		$tenbang = "departments";
		$dulieucu = array();
		$dulieumoi = array(
			'tenpb' => $tenpb,
		);
		$matk_admin = $_SESSION['matk_admin'];
		$trangthaithaydoi = "create";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
	}
	public function modelDelete()
	{
		$mapb = isset($_GET["mapb"]) && $_GET["mapb"] > 0 ? $_GET["mapb"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		// Lưu thông tin cũ
		$query_change = $db->prepare("SELECT * FROM departments WHERE mapb = :var_mapb");
		$query_change->execute(["var_mapb" => $mapb]);
		$dulieucu = $query_change->fetch();
		// Ghi vào bảng changelog
		$tenbang = "departments";
		$dulieumoi = array();
		$matk_admin = $_SESSION['matk_admin'];
		$trangthaithaydoi = "delete";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
		//chuan bi truy van
		$query = $db->prepare("delete from departments where mapb=:var_mapb");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_mapb" => $mapb]);
	}
}
