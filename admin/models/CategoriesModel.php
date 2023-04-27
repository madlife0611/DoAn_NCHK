<?php
trait CategoriesModel
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
		$query = $db->query("select * from categories order by madm asc limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	//tinh tong cac ban ghi
	public function modelTotalRecord()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from categories");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//lay mot ban ghi tuong ung voi madm truyen vao
	public function modelGetRecord()
	{
		$madm = isset($_GET["madm"]) && $_GET["madm"] > 0 ? $_GET["madm"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//chuan bi truy van
		$query = $db->prepare("select * from categories where madm=:var_madm");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_madm" => $madm]);
		//tra ve mot ban ghi
		return $query->fetch();
	}
	//xem sản phẩm theo danh mục
	public function modelReadCategory($recordPerPage)
	{
		$madm = isset($_GET["madm"]) ? $_GET["madm"] : 0;
		//lay bien page truyen tu url
		$page = isset($_GET["p"]) && $_GET["p"] > 0 ? ($_GET["p"] - 1) : 0;
		//lay tu ban ghi nao
		$from = $page * $recordPerPage;
		//---
		//---sap xep theo khau hao, gia nhap, ngay nhap---------------
		$sqlOrder = "";
		$order = isset($_GET["order"]) ? $_GET["order"] : "";
		switch ($order) {
			case 'idtang':
				$sqlOrder = "order by masp asc";
				break;
			case 'idgiam':
				$sqlOrder = "order by masp desc";
				break;
			case 'thoigiandenhanbaotritang':
				$sqlOrder = "order by DATEDIFF(hanbaotri, NOW()) asc";
				break;
			case 'thoigiandenhanbaotrigiam':
				$sqlOrder = "order by DATEDIFF(hanbaotri, NOW()) desc";
				break;
			case 'ngaynhapxa':
				$sqlOrder = "order by ngaynhap asc";
				break;
			case 'ngaynhapgan':
				$sqlOrder = "order by ngaynhap desc";
				break;
			case 'trangthai_tudo':
				$sqlOrder = "and trangthai = 0 order by masp desc";
				break;
			case 'trangthai_dangsudung':
				$sqlOrder = "and trangthai = 1 order by masp desc";
				break;
			case 'trangthai_dangbaotri':
				$sqlOrder = "and trangthai = 2 order by masp desc";
				break;
			case 'trangthai_hong':
				$sqlOrder = "and trangthai = 3 order by masp desc";
				break;
			default:
				$sqlOrder = "order by masp desc";
				break;
		}
		
		//---
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from products where madm in (select madm from categories where madm=$madm) $sqlOrder limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	public function modelTotalRecordCategory(){
		$madm =isset($_GET["madm"]) ? $_GET["madm"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from products where madm in (select madm from categories where madm=$madm)");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	public function modelUpdate()
	{
		$madm = isset($_GET["madm"]) && $_GET["madm"] > 0 ? $_GET["madm"] : 0;
		$tendm = $_POST["tendm"];
		$mota = $_POST["mota"];
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		// Lưu thông tin cũ
		$query_change = $db->prepare("SELECT * FROM categories WHERE madm = :var_madm");
		$query_change->execute(["var_madm" => $madm]);
		$dulieucu = $query_change->fetch();
		// Lấy dữ liệu cập nhật vào bảng changelog
		$tenbang = "categories";
		$dulieumoi = array(
			'madm' => $madm,
			'mota' => $mota,
			'tendm' => $tendm
		);
		$matk_admin = $_SESSION['matk_admin'];
		$trangthaithaydoi = "update";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
		//chuan bi truy van
		$query = $db->prepare("update categories set tendm = :var_tendm, mota = :var_mota where madm=:var_madm");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_madm" => $madm, "var_mota" => $mota, "var_tendm" => $tendm]);
	}
	public function modelCreate()
	{
		$tendm = $_POST["tendm"];
		$mota = $_POST["mota"];
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//chuan bi truy van
		$query = $db->prepare("insert into categories set tendm = :var_tendm, mota = :var_mota");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_mota" => $mota, "var_tendm" => $tendm]);
		// Ghi vào bảng changelog
		$tenbang = "categories";
		$dulieucu = array();
		$dulieumoi = array(
			'mota' => $mota,
			'tendm' => $tendm,
		);
		$matk_admin = $_SESSION['matk_admin'];
		$trangthaithaydoi = "create";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
	}
	public function modelDelete()
	{
		$madm = isset($_GET["madm"]) && $_GET["madm"] > 0 ? $_GET["madm"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		// Lưu thông tin cũ
		$query_change = $db->prepare("SELECT * FROM categories WHERE madm = :var_madm");
		$query_change->execute(["var_madm" => $madm]);
		$dulieucu = $query_change->fetch();
		// Ghi vào bảng changelog
		$tenbang = "categories";
		$dulieumoi = array();
		$matk_admin = $_SESSION['matk_admin'];
		$trangthaithaydoi = "delete";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
		//chuan bi truy van
		$query = $db->prepare("delete from categories where madm=:var_madm");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_madm" => $madm]);
	}
}
