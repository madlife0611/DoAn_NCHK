<?php
trait ProductsModel
{
	public function modelRead($recordPerPage)
	{
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
				$sqlOrder = "where trangthai = 0 order by masp desc";
				break;
			case 'trangthai_dangsudung':
				$sqlOrder = "where trangthai = 1 order by masp desc";
				break;
			case 'trangthai_dangbaotri':
				$sqlOrder = "where trangthai = 2 order by masp desc";
				break;
			case 'trangthai_hong':
				$sqlOrder = "where trangthai = 3 order by masp desc";
				break;
			default:
				$sqlOrder = "order by masp desc";
				break;
		}
		//---
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select *, DATEDIFF(hanbaotri, NOW()) AS thoigiandenhanbaotri from products $sqlOrder limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	//tinh tong cac ban ghi
	public function modelTotalRecord()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from products");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//hien thi cac danh muc cap con
	public function modelCategoriesSub($madm)
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from categories where danhmuccha = $madm");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetchAll();
	}
	//hien thi cac danh muc cap 0
	public function modelCategories()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from categories where danhmuccha = 0");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetchAll();
	}
	public function modelSuppliers()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from suppliers");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetchAll();
	}
	//lay 1 ban ghi category
	public function getCategory($madm)
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from categories where madm = $madm");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetch();
	}
	//lay 1 ban ghi category
	public function getCompany($macty)
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from companies where macty = $macty");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetch();
	}
	//lay mot ban ghi tuong ung voi masp truyen vao
	public function modelGetRecord()
	{
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//chuan bi truy van
		$query = $db->prepare("select * from products where masp=:var_masp");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_masp" => $masp]);
		//tra ve mot ban ghi
		return $query->fetch();
	}
}
?>